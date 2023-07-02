@extends(auth()->user()->role.'.layout')

@section('body')
<link rel="stylesheet" href="{{asset('assets/css/chat.min.css')}}">
<div class="messaging">
  <div class="inbox_msg">
    <div class="inbox_people">
      <div class="headind_srch">
        <div class="recent_heading">
          <h4>Kontak</h4>
        </div>
        <div class="srch_bar">
          <div class="stylish-input-group">
            <input type="text" class="search-bar"  placeholder="Search" >
            <span class="input-group-addon">
            <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
            </span> </div>
        </div>
      </div>
      <div class="inbox_chat">
        @foreach (\App\Models\User::where('id','<>',auth()->user()->id)->get() as $row)
        <div class="chat_list" style="cursor: pointer;">
          <div class="chat_people">
            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
            <div class="chat_ib">
              <h5>{{$row->name}} <div class="badge bg-info">{{$row->role}}</div><span class="chat_date">Dec 25</span></h5>
              <p>Test, which is a new approach to have all solutions
                astrology under one roof.</p>
            </div>
          </div>
        </div>

        @endforeach

      </div>
    </div>
    <div class="mesgs">
      <div class="msg_history">
        <div class="incoming_msg">
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
        </div>
        <div class="incoming_msg">
          <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
          <div class="received_msg">
            <div class="received_withd_msg">
              <p>Test, which is a new approach to have</p>
              <span class="time_date"> 11:01 AM    |    Yesterday</span></div>
          </div>
        </div>
        <div class="incoming_msg">
          <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
          <div class="received_msg">
            <div class="received_withd_msg">
              <p>Test, which is a new approach to have</p>
              <span class="time_date"> 11:01 AM    |    Yesterday</span></div>
          </div>
        </div>
        <div class="incoming_msg">
          <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
          <div class="received_msg">
            <div class="received_withd_msg">
              <p>Test, which is a new approach to have</p>
              <span class="time_date"> 11:01 AM    |    Yesterday</span></div>
          </div>
        </div>
        <div class="outgoing_msg">
          <div class="sent_msg">
            <p>Apollo University, Delhi, India Test</p>
            <span class="time_date"> 11:01 AM    |    Today</span> </div>
        </div>
        <div class="incoming_msg">
          <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
          <div class="received_msg">
            <div class="received_withd_msg">
              <p>We work directly with our designers and suppliers,
                and sell direct to you, which means quality, exclusive
                products, at a price anyone can afford.</p>
              <span class="time_date"> 11:01 AM    |    Today</span></div>
          </div>
        </div>
      </div>
      <div class="type_msg">
        <div class="input_msg_write">
          <input type="text" class="write_msg" placeholder="Type a message" />
          <button class="msg_send_btn" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:15px;">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>



</div></div>
@endsection
