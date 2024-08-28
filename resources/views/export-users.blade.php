<table>
    <thead>
    <tr>
        <th>رقم</th>
        <th>الإسم</th>
        <th>الإيميل</th>
        <th>عدد البيوت</th>
    </tr>
    </thead>
    <tbody>
    @php($i = 0 )
    @foreach($users as $user)
        <tr>
            <td>{{++$i}}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->house_count }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
