<div class="w-full">
    <table class="table-auto w-full">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{$header}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($headers) }}">
                        {{ __('No data displayed') }}
                    </td>
                </tr>
            @endforelse
            @if ($actions)

            @endif
        </tbody>
    </table>
</div>