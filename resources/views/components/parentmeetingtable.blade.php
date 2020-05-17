@if($meetings->count()>0)
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">With</th>
            <th scope="col">Scheduled At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($meetings as $meeting)
            <tr>
                <td>{{$meeting->name}}</td>
                <td>{{$meeting->user()->get()[0]->name}}</td>
                <td>{{date("F jS, Y", strtotime($meeting->scheduled_at))}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class="alert alert-primary" role="alert">No Meetings Scheduled</div>
@endif
