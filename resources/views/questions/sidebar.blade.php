                <style type="text/css">
                    .user-panel {float: left; margin-bottom: 30px; margin-top: 20px;}
                    .user-panel .panel-content { padding-left: 10px;}
                    .panel-content-table {border-collapse: collapse;border-spacing: 0; width: 100%; overflow: auto;}
                    .panel-content-table td {padding: 4px 0;vertical-align: inherit;}
                    .panel-content-table td.count-cell {width:30px;}
                    .mini-counts {font-size: 12px; font-weight: normal; line-height: 1.3; text-align: center; color: #6a737c; min-width: 30px; height: auto; padding: 3px 6px; margin-right: 10px; display: inline-block; border: 1px solid #b9b9b9; border-radius: 2px; }
                    .mini-counts.best {background-color: #e4f3c5; color: #4F8A32;}
                    a.title-hyperlink {color: #008ad6; font-size: 13px; font-weight: normal; line-height: 1.3; display: block; white-space: unset;}
                </style>
                <div ng-if="tab != 0">
                    <div ng-init="getListTags(0)"></div>
                </div>
                <div class="row sidebar" >
                    <div class="col-md-10 col-md-offset-1" style="padding:0 18px;">
                        <a href="{{route('showQuestionCreateFrom')}}"  class="btn btn-info" style="width: 100%;" >Đăng câu hỏi</a>
                    </div>
                    <div class="col-md-10 col-md-offset-1" ng-hide="tab === 0">
                        <input placeholder="Tìm kiếm" type="text" ng-model="keywords" ng-change="search()" class="form-control" required>
                    </div>
                    @verbatim
                        <div ng-show="tab === 0" class="col-md-11 col-md-offset-1 user-panel">
                            <p class="menu-label">Câu hỏi liên quan</p>
                            <div class="panel-content">
                                <table class="panel-content-table">
                                    <tbody>
                                        <tr ng-repeat="related in related_questions">
                                            <td class="count-cell">
                                                <div class="mini-counts" ng-class="{best:related.question.is_resolved === 1}">{{related.question.votes_count}}</div>
                                            </td>
                                            <td >
                                                <a class="title-hyperlink" href="/questions/question/{{related.question.id}}">{{related.question.title}}</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class = "col-md-11 col-md-offset-1">
                            <p class="menu-label"><i class="fa fa-tags" aria-hidden="true"></i> Tags</p>
                            <select selector
                                    multi="false"
                                    model="tags_category_id"
                                    options="categories"
                                    value-attr="id"
                                    label-attr="title"
                                    placeholder="Tất cả danh mục" 
                                    change ="changeCategory(newValue)" 
                                    style="margin-left: 8px;max-width: 268px;"></select>
                            <div class="sidebar-tags">
                                <ul>
                                    <li ng-repeat="tag in sidebarTags"><a href="/questions/tagged/?id={{tag.id}}">{{tag.name}} <span class="badge badge-primary badge-pill">{{tag.questions_count}}</span></a></li>
                                </ul>
                            </div>
                        </div>
                    @endverbatim
                </div>