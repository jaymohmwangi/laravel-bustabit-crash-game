<?php

namespace Tests\Unit;

use App\Contracts\ChatMessageRepositoryContract;
use App\Models\ChatMessage;
use App\Services\ChatMessageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Facades\ChatMessageServiceFacade as Chat;
class ChatMessageServiceTest extends TestCase
{
    use WithFaker;

    protected $chatMessageService;
    protected $chatMessageRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->chatMessageRepository = $this->createMock(ChatMessageRepositoryContract::class);
        $this->chatMessageService = new ChatMessageService($this->chatMessageRepository);
    }


    /** @test */
    public function it_can_create_a_chat_message()
    {
        // Create data for the chat message
        $data = [
            'user_id' => 1,
            'message' => $this->faker->sentence,
            'is_bot' => false,
            'channel' => 'general',
        ];

        // Call the service's create method with the data
        $chatMessage = Chat::create($data);

        // Assert that the returned chat message is an instance of stdClass and has the expected properties
        $this->assertInstanceOf(ChatMessage::class, $chatMessage);
        $this->assertEquals($data['user_id'], $chatMessage->user_id);
        $this->assertEquals($data['message'], $chatMessage->message);
        $this->assertEquals($data['is_bot'], $chatMessage->is_bot);
        $this->assertEquals($data['channel'], $chatMessage->channel);
    }

    /** @test */
    public function it_can_find_a_chat_message_by_id()
    {
      // Create data for the chat message
        $data = [
            'user_id' => 1,
            'message' => $this->faker->sentence,
            'is_bot' => false,
            'channel' => 'general',
        ];
        // Call the service's create method with the data
        $newChatMessage =Chat::create($data);
        //get the insert ID
        $id=$newChatMessage->id;
        // Call the service's find method with the id
        $chatMessage = Chat::find($id);
        // Assert that the returned chat message is an instance of stdClass and has the expected id
        $this->assertInstanceOf(ChatMessage::class??null, $chatMessage);
        $this->assertEquals($newChatMessage->id, $chatMessage->id);
    }

    /** @test */
    public function it_can_get_all_chat_messages()
    {

        // Call the service's all method
        $chatMessages = Chat::all();

        // Assert that the returned array has a count of 2 and contains instances of stdClass
        $this->assertGreaterThanOrEqual(2, count($chatMessages));
        $this->assertInstanceOf(ChatMessage::class, $chatMessages[0]);
        $this->assertInstanceOf(ChatMessage::class, $chatMessages[1]);
    }

    /** @test */
    public function it_can_delete_a_chat_message_by_id()
    {
        // Create data for the chat message
        $data = [
            'user_id' => 1,
            'message' => $this->faker->sentence,
            'is_bot' => false,
            'channel' => 'general',
        ];
        // Call the service's create method with the data
        $newChatMessage =Chat::create($data);
        //get the insert ID
        $id=$newChatMessage->id;
        // Call the service's delete method with the id
        Chat::delete($id);
        // Call the service's find method with the id
        $chatMessage = Chat::find($id);
        // Assert that the result is true
        $this->assertNull($chatMessage);
    }
}
