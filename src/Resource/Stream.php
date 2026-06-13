<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\StreamDto;
use EnricoDeLazzari\Wethod\Dto\StreamLeaderDto;
use EnricoDeLazzari\Wethod\Dto\StreamMemberDto;
use EnricoDeLazzari\Wethod\Requests\Stream\ArchiveStream;
use EnricoDeLazzari\Wethod\Requests\Stream\AttachLeaderToStream;
use EnricoDeLazzari\Wethod\Requests\Stream\AttachMemberToStream;
use EnricoDeLazzari\Wethod\Requests\Stream\CreateStream;
use EnricoDeLazzari\Wethod\Requests\Stream\DeleteStream;
use EnricoDeLazzari\Wethod\Requests\Stream\DetachStreamLeader;
use EnricoDeLazzari\Wethod\Requests\Stream\GetStream;
use EnricoDeLazzari\Wethod\Requests\Stream\ListStreamLeaders;
use EnricoDeLazzari\Wethod\Requests\Stream\ListStreamMembers;
use EnricoDeLazzari\Wethod\Requests\Stream\ListStreams;
use EnricoDeLazzari\Wethod\Requests\Stream\UnarchiveStream;
use EnricoDeLazzari\Wethod\Requests\Stream\UpdateStream;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Stream extends BaseResource
{
    public function archiveStream(int $id): StreamDto
    {
        return $this->connector->send(new ArchiveStream($id))->dto();
    }

    /**
     * @return array<int, StreamDto>
     */
    public function listStreams(?string $isArchived = null, ?string $include = null, ?string $order = null, ?string $search = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListStreams($isArchived, $include, $order, $search, $limit, $offset, $updatedAt))->dto();
    }

    public function createStream(array $data = []): StreamDto
    {
        return $this->connector->send(new CreateStream($data))->dto();
    }

    public function getStream(int $id): StreamDto
    {
        return $this->connector->send(new GetStream($id))->dto();
    }

    public function deleteStream(int $id): Response
    {
        return $this->connector->send(new DeleteStream($id));
    }

    public function updateStream(int $id, array $data = []): StreamDto
    {
        return $this->connector->send(new UpdateStream($id, $data))->dto();
    }

    /**
     * @return array<int, StreamLeaderDto>
     */
    public function listStreamLeaders(string $streamId, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListStreamLeaders($streamId, $limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }

    public function attachLeaderToStream(string $streamId, string $leaderId): StreamLeaderDto
    {
        return $this->connector->send(new AttachLeaderToStream($streamId, $leaderId))->dto();
    }

    public function detachStreamLeader(string $streamId, string $leaderId): Response
    {
        return $this->connector->send(new DetachStreamLeader($streamId, $leaderId));
    }

    /**
     * @return array<int, StreamMemberDto>
     */
    public function listStreamMembers(string $streamId, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListStreamMembers($streamId, $limit, $offset, $updatedAt))->dto();
    }

    public function attachMemberToStream(string $streamId, string $memberId): StreamMemberDto
    {
        return $this->connector->send(new AttachMemberToStream($streamId, $memberId))->dto();
    }

    public function unarchiveStream(int $id): StreamDto
    {
        return $this->connector->send(new UnarchiveStream($id))->dto();
    }
}
