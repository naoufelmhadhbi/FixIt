<?php
namespace AppBundle\Service;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

class Validate
{
    private $validator;
    private $em;
    /**
     * Validate constructor.
     * @param ValidatorInterface $validator
     * @param ManagerRegistry $registry
     */
    public function __construct(ValidatorInterface $validator,ManagerRegistry $registry)
    {
        $this->validator=$validator;
        $this->em=$registry;
    }

    public function validateRequest($data)
    {
        $errors = $this->validator->validate($data);
        $errorsResponse = array();
        /** @var ConstraintViolation $error */
        foreach ($errors as $error) {
            $errorsResponse[] = [
                'field' => $error->getPropertyPath(),
                'message' => $error->getMessage()
            ];
        }

        if (count($errors))
        {
            $reponse=array(
                'code'=>1,
                'message'=>'validation errors',
                'errors'=>$errorsResponse,
                'result'=>null
            );
            return $reponse;
        }else{
            $reponse=[];
            return $reponse;


        }
    }

}