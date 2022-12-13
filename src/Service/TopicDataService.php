<?php

namespace App\Service;

use App\Command\CreateTopicCommand;
use App\Entity\Topic;
use App\Repository\TopicRepository;
use Doctrine\ORM\EntityManagerInterface;

class TopicDataService
{
    public function __construct(
        private TopicRepository $topicRepo,
        private EntityManagerInterface $em
    ) {

    }
    /** @return Topic[] */
    public function getAllTopics(): array
    {
        return $this->topicRepo->findAll();
    }

    public function createNewTopic(CreateTopicCommand $createTopicCommand): Topic
    {
        $topic = new Topic($createTopicCommand->getName(), $createTopicCommand->getData());

        $this->topicRepo->add($topic);

        return $topic;
    }
}