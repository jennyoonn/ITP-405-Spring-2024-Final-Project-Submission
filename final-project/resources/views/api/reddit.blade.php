@extends('layout')

@section('title', 'Forum')

@section('main')
    <div class="container task-wrapper">
    <h1 class="mt-5 mb-4">Search to help with tasks:</h1>
    <form action="{{ route('reddit.forum')}}" method="get" class="input-group mb-3">
        @csrf
        <input type="text"  class="form-control" name="subreddit" placeholder="Ask ways to finish you task"/>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @if(isset($subreddit))
            <h2 >You searched: {{ $subreddit}}</h2>
            <table class="table">
                <tr>
                    <th> Title </th>
                    <th> Self-Text <th>
                </tr>
                @foreach ($response->data->children as $child)
                    @if(isset($child->data->title))
                        <tr>
                            <td>{{ $child->data->title }}</td>
                            <td>
                                @if(isset($child->data->selftext))
                                    {{$child->data->selftext}}
                                @elseif(!isset($child->data->selftext)) 
                                    no self text 
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
        @else
            <p>No data available</p>
    @endif
    </div>
    
    @endsection

