@extends(auth()->user()->role.'.layout')

@section('body')

@php
$sessions = \App\Models\ChatSession::whereHas('chats',function($query) {
  $query->where('sender_id',auth()->user()->id)->orWhere('receiver_id',auth()->user()->id);
})->get();
@endphp
<style>
  .active-list{
    background: rgb(202, 202, 202);
  }
</style>
<link rel="stylesheet" href="{{asset('assets/css/chat.min.css')}}">
<div class="messaging">
  <div class="inbox_msg">
    <div class="inbox_people">
      <div class="headind_srch">
        <div class="recent_heading">
          <h4>Riwayat</h4>
        </div>
        {{-- <div class="srch_bar">
          <div class="stylish-input-group">
            <input type="text" class="search-bar"  placeholder="Search" >
            <span class="input-group-addon">
            <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
            </span> </div>
        </div> --}}
      </div>
      <div class="inbox_chat">
        @forelse ($sessions as $K => $row)
        @php
        $latestChat = $row->chats()->latest()->first();
        @endphp
        <div class="chat_list chat_list{{$row->id}} @if($K > 0 || request('receiver_id')) @else active-list @endif " style="cursor: pointer;" onclick="$('.msg-panel').hide();$('#panel-{{$row->id}}').show();$('.chat_list').removeClass('active-list');$(this).addClass('active-list');">
          <div class="chat_people">
            <div class="chat_img">
              <img src="{{asset('storage/profile/'.auth()->user()->photo)}}" style="border-radius:99999px;max-width:41px!important;height:41px;width:41px;" alt="sunil">
            </div>
            <div class="chat_ib">
              <h5>
                {{$latestChat->receiver_id == auth()->id() ? $latestChat->sender->name:$latestChat->receiver->name}}
                <span class="chat_date">{{$latestChat->created_at->locale('id')->diffForHumans()}}</span>
              </h5>
              <p>{{$latestChat->text}}</p>
            </div>
          </div>
        </div>
        @empty
        <div style="padding: 1rem;">Belum Ada Riwayat</div>
        @endforelse

      </div>
    </div>
    @forelse ($sessions as $K => $row)
    @php
    $latestChat = $row->chats()->latest()->first();
    @endphp
    <script>
      $(document).ready(function() {
        if ({{request('receiver_id') == ($latestChat->receiver_id == auth()->id() ? $latestChat->sender->id:$latestChat->receiver->id) ? 'true':'false'}}) {
          $('#panel-{{$row->id}}').show()
          $('.chat_list{{$row->id}}').addClass('active-list')
          $('#panel').remove()
        }
      })
    </script>
    <div class="mesgs msg-panel" style="@if($K > 0 || request('receiver_id')) display: none; @endif padding-top:.7rem;" id="panel-{{$row->id}}">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          {{$latestChat->receiver_id == auth()->id() ? $latestChat->sender->name:$latestChat->receiver->name}}
        </div>
        <button class="btn btn-sm btn-danger btn-delete" type="button" data-session-id="{{$row->id}}">Hapus</button>
      </div>
      <hr style="margin-top:.7rem;" />
      <div class="msg_history msg_history{{$row->id}}">
        @foreach ($row->chats as $rowChat)
          @if ($rowChat->sender_id == auth()->id())
          <div class="outgoing_msg">
            <div class="sent_msg">
              <p>{{$rowChat->text}}</p>
              <span class="time_date"> {{$rowChat->created_at->locale('id')->diffForHumans()}}</span> </div>
          </div>
          @else
          <div class="incoming_msg">
            <div class="incoming_msg_img">
              <img src="{{asset('storage/profile/'.auth()->user()->photo)}}" style="border-radius:99999px;max-width:41px!important;height:41px;width:41px;" alt="sunil">
            </div>
            <div class="received_msg">
              <div class="received_withd_msg">
                <p>{{$rowChat->text}}</p>
                <span class="time_date"> {{$rowChat->created_at->locale('id')->diffForHumans()}}</span> </div>
            </div>
          </div>
          @endif
        @endforeach

      </div>
      <div class="type_msg">
        <div class="input_msg_write">
          <input type="text" class="write_msg{{$latestChat->receiver_id == auth()->id() ? $latestChat->sender->id:$latestChat->receiver->id}}" placeholder="Type a message" />
          <button class="msg_send_btn" type="button" data-session-id="{{$row->id}}" data-receiver-id="{{$latestChat->receiver_id == auth()->id() ? $latestChat->sender->id:$latestChat->receiver->id}}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:15px;">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
            </svg>
          </button>
        </div>
      </div>
    </div>
    @empty
    @if (request('receiver_id'))
    {{-- <div class="mesgs msg-panel" style="padding-top:.7rem;" id="panel">
      <div>{{\App\Models\User::find(request('receiver_id'))->name}}</div>
      <hr style="margin-top:.7rem;" />
      <div class="msg_history msg_history0">

      </div>
      <div class="type_msg">
        <div class="input_msg_write">
          <input type="text" class="write_msg{{\App\Models\User::find(request('receiver_id'))->id}}" placeholder="Type a message" />
          <button class="msg_send_btn" type="button" data-session-id="0" data-receiver-id="{{\App\Models\User::find(request('receiver_id'))->id}}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:15px;">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
            </svg>
          </button>
        </div>
      </div>
    </div> --}}
    @else
    <div class="mesgs msg-panel" style="background:white;"><div class="msg_history" style="height:463px;">
      {{-- Klik Chat di sidebar untuk menampilkan chat --}}
    </div></div>
    @endif
    @endforelse
    @if (!request('receiver_id'))

    @else
    <div class="mesgs msg-panel" style="padding-top:.7rem;" id="panel">
      <div>{{\App\Models\User::find(request('receiver_id'))->name}}</div>
      <hr style="margin-top:.7rem;" />
      <div class="msg_history msg_history0">
        {{-- <div class="incoming_msg">
          <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
          <div class="received_msg">
            <div class="received_withd_msg">
              <p>Test which is a new approach to have all
                solutions</p>
              <span class="time_date"> 11:01 AM    |    June 9</span></div>
          </div>
        </div>

        <div class="outgoing_msg">
          <div class="sent_msg">
            <p>Test which is a new approach to have all
              solutions</p>
            <span class="time_date"> 11:01 AM    |    June 9</span> </div>
        </div> --}}

      </div>
      <div class="type_msg">
        <div class="input_msg_write">
          <input type="text" class="write_msg{{\App\Models\User::find(request('receiver_id'))->id}}" placeholder="Type a message" />
          <button class="msg_send_btn" type="button" data-session-id="0" data-receiver-id="{{\App\Models\User::find(request('receiver_id'))->id}}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:15px;">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
            </svg>
          </button>
        </div>
      </div>
    </div>
    @endif
  </div>



</div></div>
{{-- <script src="{{}}"></script> --}}
@vite('resources/js/app.js')
<script>
  $(document).ready(function() {
    Echo.private(`chat.{{auth()->user()->id}}`)
    .listen('.chat.receive', (e) => {
        console.log(e.data);
        $(`.msg_history${e.data.session.id}`).append(`
          <div class="incoming_msg">
            <div class="incoming_msg_img"> <img src="{{asset('storage/profile')}}/${e.data.receiver.photo}" alt="sunil"> </div>
            <div class="received_msg">
              <div class="received_withd_msg">
                <p>${e.data.text}</p>
                <span class="time_date">${Math.floor(Math.random() * 10)} detik yang lalu</span> </div>
            </div>
          </div>
        `)
    });
    $('.msg_send_btn').click(function() {
      const sender_id = {{auth()->user()->id}}
      const session_id = $(this).data('session-id')
      let receiver_id = $(this).data('receiver-id')
      const text = $(`.write_msg${receiver_id}`).val()
      console.log(session_id)
      $(`.msg_history${session_id}`).append(`
        <div class="outgoing_msg">
          <div class="sent_msg">
            <p>${text}</p>
            <span class="time_date">${Math.floor(Math.random() * 10)} detik yang lalu</span>
          </div>
        </div>
      `)
      $(`.write_msg${receiver_id}`).val('')
      $.post('{{url('send_chat')}}', {sender_id,receiver_id,text}, data => {
        console.log(data)
      })
    })

    $('.btn-delete').click(function () {
      const sessionId = $(this).data('session-id')
      Swal.fire({
        title: 'Yakin ingin hapus ?',
        text: "Tidak bisa memulihkan data",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          document.location.href = '{{url('destroy_chat')}}/'+sessionId
          // $.get(, () => {document.location.reload();})
          // Swal.fire(
          //   'Deleted!',
          //   'Berhasil hapus file.',
          //   'success'
          // )
        }
      })
    })
  })
</script>
@endsection

