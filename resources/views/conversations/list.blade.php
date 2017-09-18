 @verbatim
 <li ng-repeat="notify in notification" class="notify-item">
 	<a href="{{notify.data.link}}">
 		<img src="{{notify.data.user.avatar}}" width="30" height="30"> 
 		<strong>{{notify.data.user.name}}</strong>
 		đã {{notify.data.kind}} {{notify.data.model}} của bạn 
 	</a>
 </li>
 @endverbatim