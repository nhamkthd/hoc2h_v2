<div ng-app="hoc2h-message" ng-controller="MessageController" ng-init="user_id={{Auth::user()->id}}">
@verbatim
    <div ng-show="show" style="position: fixed;bottom: 0px; right: 80px;">
        <div ng-repeat="conversation in listConversation" style="width: 300px;float: right;margin-left: 5px;">
            <div class="panel panel-primary">
                <div class="panel-heading top-bar">
                    <div class="col-md-8 col-xs-8 ">
                        <h3 class="panel-title"><i class="fa fa-circle user-status online" aria-hidden="true"></i> {{name}} </h3>
                    </div>
                    <div class="col-md-4 col-xs-4" style="text-align: right;">
                        &nbsp;&nbsp;<i id="minim_chat_window"  class="fa fa-minus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-times" aria-hidden="true" ng-click="close($index)"></i>
                    </div>
                </div>
                <div class="panel-body msg_container_base" style="height: 50vh">
                <div ng-repeat="msg in conversation.message">
                    <div class="row msg_container base_sent" ng-if="user_id==msg.user_id">
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_sent">
                                <p>{{msg.message}}</p>
                                <time datetime="2009-11-13T20:00">{{msg.date_created}}</time>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2 avatar">
                            <img src="{{msg.user.avatar}}" class=" img-responsive ">
                        </div>
                    </div>
                    <div class="row msg_container base_receive" ng-if="user_id!=msg.user_id">
                        <div class="col-md-2 col-xs-2 avatar">
                            <img src="{{msg.user.avatar}} " class="img-responsive">
                        </div>
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_receive">
                                <p>{{msg.message}}</p>
                                <time datetime="2009-11-13T20:00">{{msg.date_created}}</time>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="panel-footer" id="bottom">
                    <div class="input-group">
                        <input ng-enter='send_msg(message,conversation.id,$index)' ng-model='message' id="btn-input" type="text" style="margin-top: 6px;" class="form-control input-sm chat_input" placeholder="Write your message here..." />
                        <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm" id="btn-chat" ng-click="send_msg(message,conversation.id,$index)">Send</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endverbatim
</div>
