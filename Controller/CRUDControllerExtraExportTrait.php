<?php

namespace Whyte624\SonataAdminExtraExportBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

trait CRUDControllerExtraExportTrait
{
    /**
     * @param Request $request
     * @return Response
     */
    public function exportAction(Request $request = null)
    {
        /* @var CRUDController $this */
        try {
            return parent::exportAction($request);
        } catch (\RuntimeException $e) {
            $format = $request->get('format');

            $filename = sprintf(
                'export_%s_%s.%s',
                strtolower(substr($this->admin->getClass(), strripos($this->admin->getClass(), '\\') + 1)),
                date('Y_m_d_H_i_s', strtotime('now')),
                $format
            );

            $html = $this->renderView('Whyte624SonataAdminExtraExportBundle:CRUD:list.html.twig', [
                'admin' => $this->admin,
                'admin_pool' => $this->get('sonata.admin.pool'),
            ]);

            switch ($format) {
                case 'pdf':
                    return new Response(
                        $this->get('knp_snappy.pdf')->getOutputFromHtml($html, $this->getPdfOptions()),
                        200,
                        [
                            'Content-Type'          => 'application/pdf',
                            'Content-Disposition'   => 'attachment; filename="' . $filename . '"'
                        ]
                    );
                    break;
                case 'jpg':
                    return new Response(
                        $this->get('knp_snappy.image')->getOutputFromHtml($html, $this->getJpgOptions()),
                        200,
                        [
                            'Content-Type'          => 'image/jpeg',
                            'Content-Disposition'   => 'attachment; filename="' . $filename . '"'
                        ]
                    );
                    break;
                default:
                    throw $e;
            }
        }
    }

    protected function getJpgOptions()
    {
        return ['width' => 2480, 'height' => 3508];
    }

    protected function getPdfOptions()
    {
//        return ['orientation' => 'landscape'];
        return [];
    }

}
