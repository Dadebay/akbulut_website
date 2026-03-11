@extends('layouts.app')
@section('title')
    Otzyv
@endsection

@section('css')
    <style>

        .timeline-item {
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
            border-radius: .25rem;
            background: #fff;
            color: #495057;
            margin-left: 15px;
            margin-right: 15px;
            margin-top: 0;
            padding: 0;
            position: relative;
        }

        .time {
            color: #999;
            float: right;
            font-size: 12px;
            padding: 10px;
        }

        .timeline-header {
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            color: #495057;
            font-size: 16px;
            line-height: 1.1;
            margin: 0;
            padding: 10px;
        }

        .timeline-body, .timeline-footer {
            padding: 10px;
        }

    </style>
@endsection
@section('content')

    <div class="justify-content-between align-items-center flex-wrap">

        <div class="float-left">
            <h4 class="mb-3 mb-md-0">Feedbacks</h4>
        </div>


        <div class="clearfix mb-3"></div>

        @foreach($feedbacks as $feedback)
            <div>
                <div class="timeline-item my-3">
                    <span class="time"><i class="fas fa-clock"></i> {{ $feedback->created_at->diffForHumans() }}</span>
                    <h3 class="timeline-header"><b>{{ $feedback->name }}</b> sent you feedback</h3>

                    <div class="timeline-body">
                        {{ $feedback->body }}
                       
                    </div>

                    <blockquote class="float-right mr-3"><i>{{ $feedback->phone}}</i></blockquote>
                    <div class="timeline-footer">
                        <form method="post" action="{{ route('feedbacks.destroy', $feedback->id) }}" class="edit-delete"
                              id="em-{{ $feedback->id }}">
                            @csrf
                            @method('delete')

                            <a href="#" class="btn btn-danger " title="remove"
                               onclick="if(confirm('are u sure u want to delete this feedback?'))
                                       { document.getElementById('em-{{ $feedback->id }}').submit() }"
                            ><i data-icon="remove"></i> DELETE </a>

                        </form>
                    </div>
                </div>
            </div>

        @endforeach
        <div class="w-100 justify-content-center d-flex py-5">
            {{ $feedbacks->links() }}
        </div>
    </div>





@endsection

@section('js')

@endsection
