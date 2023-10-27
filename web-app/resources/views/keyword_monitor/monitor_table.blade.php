<table class="table">
    <thead>
        <tr>
         
            <th>Track Keyword</th>
            <th>From Dock</th>
            <th>Email Alert</th>
           
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($audioAlerts as $audioAlert)
            <tr>
               @php
                   $audioArray = explode(',', $audioAlert->audio_array);
               @endphp 

                <td>@foreach ($audioArray as $item)
                    <span class="badge bg-soft-primary text-primary">{{ $item }}</span>
                @endforeach
                
                </td>
                <td>{{ $audioAlert->dock->name }}</td>
                <td>{{ $audioAlert->email_alert ? 'Yes' : 'No' }}</td>
              
                <td>
                    {{-- <a href="{{ route('audio_alerts.edit', $audioAlert->id) }}" class="btn btn-primary">Edit</a> --}}
                    <form action="{{ route('audio_alerts.destroy', $audioAlert->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>