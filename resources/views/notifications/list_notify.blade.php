 @verbatim

 <li ng-repeat="notify in notification" class="notify-item">
 	<a href="{{notify.data.link}}">
 		<img src="{{notify.data.user.avatar}}" width="25" height="25"> 
 		<strong style="color: #0099CC;">{{notify.data.user.name}}</strong>
 		đã {{notify.data.kind}} {{notify.data.model}} của bạn 
 	</a>
 </li>
  @endverbatim