@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">

        <h4 class="text-center mb-4" style="color: #543c93"><b>{{__("l.message")}}</b></h4>

        <table class="table table-ticket">
            <tbody>
                <tr class="ticketlistproperties">
                    <td width="20%">{{__("l.website")}}</td>
                    <td>{{@$message->website->{"name_".app()->getLocale()} }}</td>
                </tr>
                <tr class="ticketlistproperties">
                    <td>{{__("l.name")}}</td>
                    <td>{{$message->name}}</td>
                </tr>
                <tr class="ticketlistproperties">
                    <td>{{__("l.email")}}</td>
                    <td>{{$message->email}}</td>
                </tr>
                <tr class="ticketlistproperties">
                    <td>{{__("l.subject")}}</td>
                    <td>{{$message->subject}}</td>
                </tr>
                <tr class="ticketlistproperties">
                    <td>{{__("l.date")}}</td>
                    <td>{{$message->created_at}}</td>
                </tr>
                <tr class="ticketlistproperties">
                    <td>{{__("l.message")}}</td>
                    <td>{{$message->message}}</td>
                </tr>
            </tbody>
        </table>

    </div>

@endsection
