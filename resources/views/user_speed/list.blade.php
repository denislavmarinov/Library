@php
    $title = "Reading gspeed";
 @endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">Reading speed</h1>
@endsection
@section('content')
<br>
<table class="table">
    <tr class="badge-success">
        <td>#</td>
        <td>Monday</td>
        <td>Tuesday</td>
        <td>Wednesday</td>
        <td>Thursday</td>
        <td>Friday</td>
        <td>Saturday</td>
        <td>Sunday</td>
        <td>Pages for this week</td>
        <td>Week</td>
        <td>Year</td>
    </tr>
    @php
        $num = 1;
    @endphp
    @if ($user_speed->count() === 0)
        <tr>
            <td colspan="11" class="text-center">Read some books to get info here!</td>
        </tr>
    @endif
    @foreach ($user_speed as $week)
        @php
            $class = "";
        @endphp

        @if ($week->week_num == $now['week_num'] && $week->year == $now['year'])
            @php
                $class = "bg-info";
            @endphp
        @endif
        <tr class="{{ $class }}">
            <td>{{ $num++ }}</td>
            <td>{{ $week->monday }}</td>
            <td>{{ $week->tuesday }}</td>
            <td>{{ $week->wednesday }}</td>
            <td>{{ $week->thursday }}</td>
            <td>{{ $week->friday }}</td>
            <td>{{ $week->saturday }}</td>
            <td>{{ $week->sunday }}</td>
            <td>{{ $week->monday + $week->tuesday + $week->wednesday + $week->thursday + $week->friday + $week->saturday + $week->sunday }}</td>
            <td>{{ $week->week_num }}</td>
            <td>{{ $week->year }}</td>
        </tr>
    @endforeach
</table>

@endsection
