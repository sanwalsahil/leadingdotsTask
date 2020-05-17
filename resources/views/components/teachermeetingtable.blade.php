@if($meetings->count()>0)
    <table class="table table-striped">
        <thead>
        <tr style="text-align:center">
            <th scope="col">Name</th>
            <th scope="col">With</th>
            <th scope="col">Scheduled At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($meetings as $meeting)
            <tr style="text-align:center">
                <td>{{$meeting->name}}</td>
                <td>
                    <ul class="list-group list-group-flush">
                        @foreach($meeting->meeting_groups()->get() as $meeting_group)

                            @foreach($meeting_group->user()->get() as $parent)

                                <li style="background-color: transparent" class="list-group-item">{{$parent->name}}</li>
                            @endforeach

                        @endforeach
                    </ul>
                </td>
                <td>{{date("F jS, Y", strtotime($meeting->scheduled_at))}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class="alert alert-primary" role="alert">No Meetings Scheduled</div>
@endif
