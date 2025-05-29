<?php

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class EventRepository
{
    protected $model;
    
    /**
     * Create a new repository instance.
     *
     * @param Event $event
     */
    public function __construct(Event $event)
    {
        $this->model = $event;
    }
    
    /**
     * Get paginated events for a specific user
     *
     * @param int $userId
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedUserEvents(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->with(['eventType', 'eventSubType', 'tags'])
                          ->where('user_id', $userId)
                          ->latest()
                          ->paginate($perPage);
    }
    
    /**
     * Find an event by ID with relationships
     *
     * @param int $id
     * @return Event|null
     */
    public function findWithRelations(int $id): ?Event
    {
        return Cache::remember('event_' . $id, 3600, function () use ($id) {
            return $this->model->with(['eventType', 'eventSubType', 'tags', 'user'])
                              ->find($id);
        });
    }
    
    /**
     * Get events by city
     *
     * @param string $city
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getEventsByCity(string $city, int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->with(['eventType', 'eventSubType'])
                          ->where('status', Event::STATUS_APPROVED)
                          ->city($city)
                          ->latest()
                          ->paginate($perPage);
    }
    
    /**
     * Get events by type
     *
     * @param int $typeId
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getEventsByType(int $typeId, int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->with(['eventType', 'eventSubType'])
                          ->where('status', Event::STATUS_APPROVED)
                          ->where('event_type_id', $typeId)
                          ->latest()
                          ->paginate($perPage);
    }
    
    /**
     * Get events pending review
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPendingEvents(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->with(['user', 'eventType'])
                          ->where('status', Event::STATUS_PENDING)
                          ->latest()
                          ->paginate($perPage);
    }
    
    /**
     * Create a new event
     *
     * @param array $data
     * @return Event
     */
    public function create(array $data): Event
    {
        return $this->model->create($data);
    }
    
    /**
     * Update an event
     *
     * @param Event $event
     * @param array $data
     * @return bool
     */
    public function update(Event $event, array $data): bool
    {
        $updated = $event->update($data);
        
        if ($updated) {
            Cache::forget('event_' . $event->id);
        }
        
        return $updated;
    }
    
    /**
     * Delete an event
     *
     * @param Event $event
     * @return bool|null
     */
    public function delete(Event $event): ?bool
    {
        Cache::forget('event_' . $event->id);
        return $event->delete();
    }
}
