<?php

namespace ShowcaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type as FormType;

class FormController extends Controller
{
    public function rawAction()
    {
        return $this->render('ShowcaseBundle:Form:raw.html.twig');
    }

    public function rawSubmitAction(Request $request)
    {
        $field = $request->request->get('field');
        $this->addFlash('raw', $field);
        return $this->redirectToRoute('form_raw');
    }
    
    public function basicFormAction(Request $request)
    {
        $form = $this->createFormBuilder(null, [
                'action' => $this->generateUrl('form_basic'),
                'method' => 'POST',
            ])
            ->add('my_text', FormType\TextType::class, [ 'attr' => ['placeholder' => 'plop']])
            ->add('my_longtext', FormType\TextareaType::class)
            ->add('my_date', FormType\DateType::class)
            ->add('my_select', FormType\ChoiceType::class, [
                'expanded' => false,
                'multiple' => false,
                'choices' => ['one'=>1,'two'=>2,'three'=>3],
            ])
            ->add('my_radio', FormType\ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'choices' => ['one'=>1,'two'=>2,'three'=>3],
            ])
            ->add('my_checkbox', FormType\ChoiceType::class, [
                'expanded' => true,
                'multiple' => true,
                'choices' => ['one'=>1,'two'=>2,'three'=>3],
            ])
            ->add('reset', FormType\ResetType::class)
            ->add('save', FormType\SubmitType::class)
            ->getForm();
        
        $message = null;
        if($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $message = 'Ok !';
            }
            else {
                
            }
        }
        return $this->render('ShowcaseBundle:Form:basic.html.twig', [
            'form' => $form->createView(),
            'message' => $message,
        ]);
    }

}
