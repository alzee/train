<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Trainee;
use App\Entity\Training;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/tg", methods={"POST"}, name="api_tg")
     */
    public function index(Request $request): Response
    {
        // $request->isXmlHttpRequest();
        //$p = $request->request->get('tgid');
        $params = json_decode($request->getContent(), true);
        $tgId = $params['tgid'];
        $tes = $params['te'];

        $em = $this->getDoctrine()->getManager();
        $tg = $this->getDoctrine()->getRepository(Training::class)->find($tgId);
        foreach($tes as $v){
            $te = $this->getDoctrine()->getRepository(Trainee::class)->find($v);
            $te->addTraining($tg);
            $em->persist($te);
            $em->flush();
        }

        return $this->json($params['te']);
    }

    /**
     * @Route("/v1/record/face", methods={"POST"}, name="api_face")
     */
    public function face(Request $request): Response
    {
        $code = 0;
        $content = '';
        $msg = '更新成功';
        $params = json_decode($request->getContent(), true);

        $res = [
            "Result" => $code,
            "Content" => $content,
            "Msg" => $msg
        ];
        //return $this->json($params['logs'][0]['photo']);
        return $this->json($res);
    }

    /**
     * @Route("/v1/stranger", methods={"POST"}, name="api_stranger")
     */
    public function stranger(Request $request): Response
    {
        $code = 0;
        $content = '';
        $msg = '更新成功';
        $params = json_decode($request->getContent(), true);

        $res = [
            "Result" => $code,
            "Content" => $content,
            "Msg" => $msg
        ];
        //return $this->json($params['logs'][0]['recog_time']);
        return $this->json($res);
    }
}
