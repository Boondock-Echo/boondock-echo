<table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Location</th>
      </tr>
    </thead>
    <tbody>
      @foreach($docks as $dock)
        <tr>
          <td>{{ $dock->id }}</td>
          <td>{{ $dock->name }}</td>
          <td>{{ $dock->location }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
