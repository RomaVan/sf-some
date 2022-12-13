<?php

namespace App\Controller;

use App\Command\CreateTopicCommand;
use App\Entity\Topic;
use App\Service\TopicDataService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TopicController extends AbstractController
{
    public function __construct(
        private TopicDataService $topicDataService,
        private EntityManagerInterface $em,
    ) {

    }
    #[Route('/Api/topics', name: 'app_topic')]
    public function index(): Response
    {
        $topics = $this->topicDataService->getAllTopics();

        return $this->json($topics);
    }

    #[Route('/Api/topic/add', name: 'app_topic_create', methods: ['POST'])]
    public function create(CreateTopicCommand $createTopicCommand): Response
    {
        $topic = $this->topicDataService->createNewTopic($createTopicCommand);

        $this->em->flush();

        return $this->json([
            'name' => $topic->getName(),
            'data' => $topic->getData()
        ]);
    }
}
