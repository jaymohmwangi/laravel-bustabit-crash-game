<?php

namespace Tests\Unit;

use App\Contracts\ChatMessageRepositoryContract;
use App\Services\ChatMessageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChatMessageServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $chatMessageService;
    protected $chatMessageRepository;

    protected function setUp(): void
    {
        parent::setUp();
        // Create a mock instance of ChatMessageRepositoryContract
        $this->chatMessageRepository = $this->createMock(ChatMessageRepositoryContract::class);
        // Instantiate ChatMessageService with the mock repository
        $this->chatMessageService = new ChatMessageService($this->chatMessageRepository);
    }

    /** @test */
    public function it_can_create_a_chat_message()
    {
        // Create data for the chat message
        $data = [
            'user_id' => 1,
            'message' => $this->faker->sentence,
            'created_at' => now(),
            'is_bot' => false,
            'channel' => 'general',
        ];

        // Expect the repository's create method to be called once with the data, and return the data as an object
        $this->chatMessageRepository->expects($this->once())
            ->method('create')
            ->with($data)
            ->willReturn((object)$data);

        // Call the service's create method with the data
        $chatMessage = $this->chatMessageService->create($data);

        // Assert that the returned chat message is an instance of stdClass and has the expected properties
        $this->assertInstanceOf(\stdClass::class, $chatMessage);
        $this->assertEquals($data['user_id'], $chatMessage->user_id);
        $this->assertEquals($data['message'], $chatMessage->message);
        $this->assertEquals($data['created_at'], $chatMessage->created_at);
        $this->assertEquals($data['is_bot'], $chatMessage->is_bot);
        $this->assertEquals($data['channel'], $chatMessage->channel);
    }

    /** @test */
    public function it_can_find_a_chat_message_by_id()
    {
        $id = 1;
        // Create data for the chat message with the specified id
        $data = (object)[
            'id' => $id,
            'user_id' => 1,
            'message' => $this->faker->sentence,
            'created_at' => now(),
            'is_bot' => false,
            'channel' => 'general',
        ];

        // Expect the repository's find method to be called once with the id, and return the data as an object
        $this->chatMessageRepository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($data);

        // Call the service's find method with the id
        $chatMessage = $this->chatMessageService->find($id);

        // Assert that the returned chat message is an instance of stdClass and has the expected id
        $this->assertInstanceOf(\stdClass::class, $chatMessage);
        $this->assertEquals($data->id, $chatMessage->id);
    }

    /** @test */
    public function it_can_get_all_chat_messages()
    {
        // Create an array of chat message data
        $data = [
            (object)[
                'id' => 1,
                'user_id' => 1,
                'message' => $this->faker->sentence,

                'created_at' => now(),
                'is_bot' => false,
                'channel' => 'general',
            ],
            (object)[
                'id' => 2,
                'user_id' => 2,
                'message' => $this->faker->sentence,
                'created_at' => now(),
                'is_bot' => false,
                'channel' => 'general',
            ],
        ];

        // Expect the repository's all method to be called once and return the array of data
        $this->chatMessageRepository->expects($this->once())
            ->method('all')
            ->willReturn($data);

        // Call the service's all method
        $chatMessages = $this->chatMessageService->all();

        // Assert that the returned array has a count of 2 and contains instances of stdClass
        $this->assertCount(2, $chatMessages);
        $this->assertInstanceOf(\stdClass::class, $chatMessages[0]);
        $this->assertInstanceOf(\stdClass::class, $chatMessages[1]);
    }

    /** @test */
    public function it_can_delete_a_chat_message_by_id()
    {
        $id = 1;

        // Expect the repository's delete method to be called once with the id and return true
        $this->chatMessageRepository->expects($this->once())
            ->method('delete')
            ->with($id)
            ->willReturn(true);

        // Call the service's delete method with the id
        $result = $this->chatMessageService->delete($id);

        // Assert that the result is true
        $this->assertTrue($result);
    }
}
