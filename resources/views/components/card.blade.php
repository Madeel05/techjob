@props(['job_type','salary','slug'])
<div class="card p-2 {{$job_type}}">
    <x-job-type-badge :type="$job_type"/>
    <div class="text-center mt-2 p-3">
        {{$image}}
        <br>
       {{$slot}}
        <div {{$address->attributes}}>
            {{$address}}
        </div>
        <div class="d-flex justify-content-between mt-3"><span>${{$salary}}</span>
            <a href="{{route('jobs.show',[$slug])}}">
                <x-apply-now-button title="Apply Now" class="btn-dark" type="button"/>
            </a>
        </div>
    </div>
</div>
