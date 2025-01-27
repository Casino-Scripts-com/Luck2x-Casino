@extends('layout')

@section('content')
<link rel="stylesheet" href="/css/profileHistory.css">
<link rel="stylesheet" href="/css/profileNew.css?v={{time()}}">
@guest
    <script>location.href='/';</script>
@endguest
@if(isset($clan['id']))
<div class="section">
<div class="profile d-flex align-start flex-wrap">
   <div class="profile__user d-flex flex-column align-center justify-center">
      <div class="profile__avatar d-flex justify-center align-center">
         <div class="profile__avatar-ellipse d-flex justify-center align-center">
            <div class="profile__avatar-img" style="background: url({{$clan['avatar']}}) no-repeat center center / cover;"></div>
         </div>
      </div>
      <div class="profile__username d-flex flex-column align-center justify-center">
         <b>
         {{$clan['name']}}
         </b>
         <div class="profile__balance d-flex align-center justify-space-between">
            <div class="btn" style="margin: auto;margin-top: 20px;" 
            @if(!in_array($u->unique_id, $clan['members'])) 
            onclick="location.href='/clan/{{ $clan['id'] }}/join';"
            @else 
            onclick="location.href='/clan/{{ $clan['id'] }}/leave';"
            @endif>

               @if(!in_array($u->unique_id, $clan['members'])) 
               <span style="color: #fff;">Join</span> 
               @else 
               <span style="color: #fff;">Leave</span> 
               @endif
            </div>
		</div>
      </div>
   </div>
   <style>
				.history_table td, .history_table th {
				    text-align: center;
				    border: none;
				}
				.history_table td {
					padding-top: 10px;
					padding-bottom:10px
				}
				.history_table td > .btn {
					padding: 11.5px;
				}
                .history_button .btn {
                    border-radius: 7px;
                }
                .history_button {
                    display: block;
                    justify-content: center;
                }
   </style>
   <div class="profile__stats" style="display: block;">
      <div class="section" style="padding: 0;border-radius: 25px;">
         <div class="wallet_container">
            <div class="wallet_component">
               <div class="history_nav">
                  <button type="button" class="btn isActive" data-tab="with"><span>List of members</span></button>
               </div>
               <div class="history_wrapper with">
                  <div class="withPager">
                     <div class="list">
                        <div class="history_scroll">
                           <table class="history_table" style="text-align: center;">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Player</th>
                                    <th>Points</th>
                                    @if($u->unique_id == $clan['admin_id'])<th>Action</th>@endif
                                 </tr>
                              </thead>
                              <tbody style="text-align: center;">
                              @foreach($members as $m)
                                 <tr>
                                    <td>@if($m['position'] > 3) {{$m['position']}} @else <img src="/img/place-{{$m['position']}}.svg" style="width:24px"> @endif</td>
                                    <td>
                                       <div class="tournament-table__col tournament-table__col_user">
                                          <div class="user-info">
                                             <div class="user-info__name user-link" data-id="{{$m['unique_id']}}" style="cursor: pointer;{{$m['style']}}">{{$m['username']}}</div>
                                          </div>
                                       </div>
                                    </td>
                                    <td>{{$m['points']}}</td>
                                    @if($u->unique_id == $clan['admin_id'])
                                    <td>
                                       <div class="history_button" onclick="location.href='/clan/{{ $clan['id'] }}/kick/{{ $m['unique_id'] }}';">
                                          <div class="btn">
                                             <span>Kick out</span>
                                          </div>
                                       </div>
                                    </td>
                                    @endif
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@else
@if($u->clan_id == 0 && $unique_id == 'my')
<div style="text-align:center;">
    <span style="font-size: 21px; font-weight: 600">You're not a member of any clan.</span>
    <p><span style="font-size: 11px; font-weight: 300">Do you want to <a href="javascript:void(0);" onclick="$('#createClan').modal('show')">create</a>your own clan or <a href="/clans">join</a> an existing one?</span></p>
</div>
        <div class="modal fade" id="createClan" tabindex="-1" role="dialog" aria-labelledby="walletModalLabel" aria-hidden="true">
            <div class="modal-dialog deposit-modal modal-dialog-centered" role="document">
               <div class="modal-content">
                  <button class="modal-close" data-dismiss="modal" aria-label="Close">
                     <svg class="icon icon-close">
                        <use xlink:href="/img/symbols.svg#icon-close"></use>
                     </svg>
                  </button>
                  <div class="deposit-modal-component">
                     <div class="wrap">
                        <div class="tabs">
                           <button type="button" class="btn btn-tab isActive" style="width: 100%">Create a Clan</button>
                        </div>
                        <div class="deposit-section tab active">
                           <form action="/clans/create" method="post" id="clan">
                              <div class="form-row">
									<label>
										<div class="form-label">Name</div>
										<div class="form-field">
										<div class="input-valid">
											<input class="input-field" id="clanName" value="" placeholder="">
											<div class="valid inline"></div>
										</div>
										</div>
									</label>
                              </div>
                              <div class="form-row">
									<label>
										<div class="form-label">Link to avatar</div>
										<div class="form-field">
										<div class="input-valid">
											<input class="input-field" id="clanAvatar" value="" placeholder="">
											<div class="valid inline"></div>
										</div>
										</div>
									</label>
                              </div>
							  <div class="form-row">
									<label>
										<div class="form-label">Points for joining</div>
										<div class="form-field">
										<div class="input-valid">
											<input class="input-field" id="clanPoints" value="" placeholder="">
											<div class="valid inline"></div>
										</div>
										</div>
									</label>
                              </div>
                              <button type="submit" class="btn btn-green">
                              Create</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @else
         <div style="text-align:center;">
            <span style="font-size: 21px; font-weight: 600">No clan with this id found...</span>
         </div>
         @endif
@endif
@endsection