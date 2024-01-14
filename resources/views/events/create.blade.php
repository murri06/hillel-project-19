<x-layout>
    <h2>Creating new event</h2>
    <form method="post" style="max-width: 30vw">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">
                Please, give title for the event
            </label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Title" required
                   @if(isset($event)) value="{{$event->title}}" @endif>

        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">
                Please, add some notes for the event
            </label>
            <input type="text" name="notes" id="notes" class="form-control" placeholder="Notes" required
                   @if(isset($event)) value="{{$event->notes}}" @endif>
        </div>

        <div class="mb-3">
            <label class="form-label" for="user_id">Select responsible user from list </label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option selected>. . .</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="dt_start" class="form-label">
                Select start date
            </label>
            <input type="date" name="dt_start" id="dt_start" class="form-select" required
                   @if(isset($event)) value="{{$event->dt_start}}" @endif>
        </div>

        <div class="mb-3">
            <label for="dt_end" class="form-label">
                Select start date
            </label>
            <input type="date" id="dt_end" name="dt_end" class="form-select" required
                   @if(isset($event)) value="{{$event->dt_end}}" @endif>
        </div>

        <button type="submit" class="btn btn-secondary" style="margin-top: 20px">Submit</button>
    </form>
</x-layout>
