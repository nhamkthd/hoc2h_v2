            
                <div class="row sidebar" >
                    <div class="col-md-10 col-md-offset-1">
                        <a href="{{route('showQuestionCreateFrom')}}"  class="btn btn-outline-default waves-effect" style="width: 100%;" >Đăng câu hỏi</a>
                         <hr>
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                        <input placeholder="Tìm kiếm" type="text" ng-model="keywords" ng-change="search()" class="form-control" required>
                    </div>
                    <div class = "col-md-10 col-md-offset-1">
                        <p class="menu-label">Thống Kê</p>
                        <section>
                            <ul class="menu-list">
                                <li ng-class="{active:tab === 1}">
                                    <a href ="{{url('/questions/')}}">
                                        <i class="fa fa-globe" aria-hidden="true"></i> Mới nhất 
                                    </a>
                                </li>
                                <li ng-class="{active:tab === 2}">
                                    <a href="{{url('/questions/?filter=hot')}}" >
                                        <i class="fa fa-flag" aria-hidden="true"></i> Nổi bật
                                    </a>
                                </li>
                                <li ng-class="{active:tab === 3}">
                                    <a  href="{{url('/questions/?filter=hotinweek')}}" >
                                        <i class="fa fa-fire" aria-hidden="true"></i> Nổi trong tuần 
                                    </a>
                                </li>
                                <li ng-class="{active:tab === 4}">
                                    <a  href="{{url('/questions/?filter=myquestions')}}" >
                                        <i class="fa fa-user" aria-hidden="true"></i> Câu hỏi của tôi  
                                    </a>
                                </li>
                                <li ng-class="{active:tab === 5}">
                                    <a  href="{{url('/questions/?filter=following')}}" >
                                        <i class="fa fa-eye" aria-hidden="true"></i> Đang theo dõi 
                                    </a>
                                    </li>
                                <li ng-class="{active:tab === 6}">
                                    <a  href="{{url('/questions/?filter=resolved')}}" >
                                        <i class="fa fa-check-square-o" aria-hidden="true"></i> Đã được giải quyết 
                                    </a>
                                </li>
                                <li ng-class="{active:tab === 7}">
                                    <a href="{{url('/questions/?filter=notresolve')}}" >
                                        <i class="fa fa-question-circle" aria-hidden="true"></i> Chưa được giải quyết 
                                    </a>
                                </li>
                                <li ng-class="{active:tab === 8}">
                                    <a  href="{{url('/questions/?filter=nothaveanswer')}}" >
                                        <i class="fa fa-commenting-o" aria-hidden="true"></i> Chưa có câu trả lời 
                                    </a>
                                </li>
                                <li ng-class="{active:tab === 9}">
                                    <a  href="{{url('/questions/?filter=hotmembers')}}">
                                        <i class="fa fa-signing" aria-hidden="true"></i> Thành viên tiêu biểu 
                                    </a>
                                </li>
                            </ul>
                        </section>
                    </div>
                    @verbatim
                        <div class = "col-md-10 col-md-offset-1">
                            <p class="menu-label">Tags</p>
                            <p class="card-tags" ng-repeat="tag in tags"><span> {{tag.title}} </span></p>
                        </div>
                    @endverbatim
                </div>