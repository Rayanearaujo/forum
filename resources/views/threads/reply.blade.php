<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <a href="#">
                    {{$reply->owner->name}}
                </a> said: {{$reply->created_at}}</div>

            <div class="card-body">
                {{$reply->body}}
            </div>
            <hr>
        </div>
    </div>
</div>