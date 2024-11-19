<?php

declare(strict_types=1);

namespace SwooleTW\Hyperf\Broadcasting\Broadcasters;

use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Log\LoggerInterface;

class LogBroadcaster extends Broadcaster
{
    /**
     * The logger implementation.
     */
    protected LoggerInterface $logger;

    /**
     * Create a new broadcaster instance.
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function auth(RequestInterface $request): mixed
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validAuthenticationResponse(RequestInterface $request, mixed $result): mixed
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function broadcast(array $channels, string $event, array $payload = []): void
    {
        $channels = implode(', ', $this->formatChannels($channels));

        $payload = json_encode($payload, JSON_PRETTY_PRINT);

        $this->logger->info('Broadcasting ['.$event.'] on channels ['.$channels.'] with payload:'.PHP_EOL.$payload);
    }
}
