<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\ProjectMember;
use App\Entity\Sample;
use App\Entity\SampleFile;
use App\Entity\TaxonomyAbundance;
use App\Entity\User;
use App\Form\FileUploadFormType;
use App\Form\FileUploadModel;
use App\Repository\TaxonomyAbundanceRepository;
use App\Util\FileParser;
use http\Exception\RuntimeException;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/")
 */
class DefaultController extends AbstractController
{


    /**
     * @var LoggerInterface
     */
    private $log;

    public function __construct(LoggerInterface $log)
    {
        $this->log = $log;
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', []);
    }

    /**
     * @Route("/start-p", name="start-process")
     * @return Response
     */
    public function startProcess() {
        // C:\Programi\sts4\.workspace\LongProcess\dist>  java -jar long-running.jar
        $process = new Process(['java', '-jar', 'C:/Programi/sts4/.workspace/LongProcess/dist/long-process.jar']);
        $process->start(function () {
            echo "Finish is";
        });

        return new Response('Process traje');
    }

    /**
     * @Route("/upload-files-form", name="upload-files-form")
     * @param Request $request
     * @param TaxonomyAbundanceRepository $taxonomyAbundanceRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function showUploadFilesForm(Request $request, TaxonomyAbundanceRepository $taxonomyAbundanceRepository)
    {
        $formModel = new FileUploadModel();
        $form = $this->createForm(FileUploadFormType::class, $formModel, [
            'user' => $this->getUser()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile[] $files */
            $files = $formModel->getFiles();
            $project = $formModel->getProject();
            $this->checkIsProjectNull($project);
            $this->checkIsProjectFromUser($project, $this->getUser());


//            $this->getDoctrine()->getRepository(ProjectMember::class)
//                ->createQueryBuilder('m')->where('m.project')

            // Move the files to the directory where brochures are stored
            try {
                /** @var UploadedFile $file */
                foreach ($files as $file) {

                    $fullPath = $file->getRealPath();
                    $parser = new FileParser($fullPath, $file->getClientOriginalName());
                    if ($formModel->getType() == SampleFile::TAXONOMY_TYPE) {
                        $sampleName = $parser->getTaxonomySampleName();
                        $sample = $this->getDoctrine()->getRepository(Sample::class)
                            ->findOneBy(['name' => $sampleName,
                                'project' => $project]);
                        if ($sample == null) {
                            $sample = new Sample();
                            $sample->setName($sample);
                            $sample->setName($project);

                        } else {

                        }

                    }

                    $newFileName = $this->generateUniqueFileName() . $file->getClientOriginalName() . '.files';

                    $this->parseFile($fullPath, $file->getClientOriginalName(), $taxonomyAbundanceRepository);
                    $newFile = $file->move("C:/Projekti/PhpstormProjects/BioSymf/files", $newFileName);
                }
                //  dump($files);
            } catch (FileException $e) {
                // ... handle exception if something happens during files upload
                dump("Error ", $e);
            }

            // updates the 'brochure' property to store the PDF files name
            // instead of its contents
            // $formModel->setBrochure($newFileName);


            // return $this->redirect($this->generateUrl('upload-files-form'));
        }

        return $this->render('default/upload-files.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    private function parseFile(string $path, string $origFileName, TaxonomyAbundanceRepository $repo)
    {
        $parser = new FileParser($path, $origFileName);
        dump("is taxonomy ", $parser->isTaxonomyType());
        if ($parser->isTaxonomyType()) {

            $taxonomyAbundances = $parser->parseTaxonomy();
            foreach ($taxonomyAbundances as $t) {
                $tax = new TaxonomyAbundance();

            }
        }

    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    private function checkIsProjectNull(?Project $project)
    {
        if ($project == null) {
            throw new \RuntimeException('Not find project');
        }
    }

    private function checkIsProjectFromUser(?Project $project, User $user)
    {
        $projectMember = $this->getDoctrine()->getRepository(ProjectMember::class)
            ->findOneBy(['project' => $project, 'user' => $user]);
        if ($projectMember != null) {
            if ($projectMember->getRole() == 'ADMIN') {
                return;
            }
        }

        throw new \RuntimeException('Project is not from user admin');
    }



}

