@props(['title'])

<div>
    <button {{$attributes->class('btn btn-primary')->merge(['type' => 'button'])}}>{{$title}}</button>
</div>
