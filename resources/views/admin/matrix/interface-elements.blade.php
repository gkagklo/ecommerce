@extends('layouts.adminLayout.admin_design')
@section('content')
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="" class="current">Interface elements</a> </div>
    <h1>Interface elements</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"><span class="icon"> <i class="icon-ok-sign"></i> </span>
            <h5>Labels and badges</h5>
          </div>
          <div class="widget-content">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Labels</th>
                  <th>Markup</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><span class="label">Default</span></td>
                  <td><code>&lt;span class="label"&gt;</code></td>
                </tr>
                <tr>
                  <td><span class="label label-success">Success</span></td>
                  <td><code>&lt;span class="label label-success"&gt;</code></td>
                </tr>
                <tr>
                  <td><span class="label label-warning">Warning</span></td>
                  <td><code>&lt;span class="label label-warning"&gt;</code></td>
                </tr>
                <tr>
                  <td><span class="label label-important">Important</span></td>
                  <td><code>&lt;span class="label label-important"&gt;</code></td>
                </tr>
                <tr>
                  <td><span class="label label-info">Info</span></td>
                  <td><code>&lt;span class="label label-info"&gt;</code></td>
                </tr>
                <tr>
                  <td><span class="label label-inverse">Inverse</span></td>
                  <td><code>&lt;span class="label label-inverse"&gt;</code></td>
                </tr>
              </tbody>
            </table>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Example</th>
                  <th>Markup</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td> Default </td>
                  <td><span class="badge">1</span></td>
                  <td><code>&lt;span class="badge"&gt;</code></td>
                </tr>
                <tr>
                  <td> Success </td>
                  <td><span class="badge badge-success">2</span></td>
                  <td><code>&lt;span class="badge badge-success"&gt;</code></td>
                </tr>
                <tr>
                  <td> Warning </td>
                  <td><span class="badge badge-warning">4</span></td>
                  <td><code>&lt;span class="badge badge-warning"&gt;</code></td>
                </tr>
                <tr>
                  <td> Important </td>
                  <td><span class="badge badge-important">6</span></td>
                  <td><code>&lt;span class="badge badge-important"&gt;</code></td>
                </tr>
                <tr>
                  <td> Info </td>
                  <td><span class="badge badge-info">8</span></td>
                  <td><code>&lt;span class="badge badge-info"&gt;</code></td>
                </tr>
                <tr>
                  <td> Inverse </td>
                  <td><span class="badge badge-inverse">10</span></td>
                  <td><code>&lt;span class="badge badge-inverse"&gt;</code></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-hand-right"></i> </span>
            <h5>Different notifications</h5>
          </div>
          <div class="widget-content notify-ui">
            <ul id="gritter-notify">
              <li class="normal">Standard notification</li>
              <li class="sticky">Sticky notification</li>
              <li class="image" data-image="{{ asset('/images/backend_images/demo/envelope.png') }}">Notification with image</li>
            </ul>
          </div>
        </div>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-hand-right"></i> </span>
            <h5>Icon With box</h5>
          </div>
          <div class="widget-content">
            <ul class="quick-actions">
              <li class="bg_lb"> <a href="#"> <i class="icon-book"></i> icon-book </a> </li>
              <li class="bg_lg"> <a href="#"> <i class="icon-tasks"></i> icon-cabinet</a> </li>
              <li class="bg_ly"> <a href="#"> <i class="icon-calendar"></i> icon-calendar </a> </li>
              <li class="bg_lo"> <a href="#"> <i class="icon-user"></i> icon-client</a> </li>
              <li class="bg_ls"> <a href="#"> <i class="icon-upload-alt"></i> icon-database </a> </li>
              <li class="bg_lb"> <a href="#"> <i class="icon-download"></i> icon-download </a> </li>
              <li class="bg_lg"> <a href="#"> <i class="icon-bar-chart"></i> icon-graph </a> </li>
              <li class="bg_lo"> <a href="#"> <i class="icon-home"></i>icon-home </a> </li>
              <li class="bg_ls"> <a href="#"> <i class="icon-lock"></i> icon-lock </a> </li>
              <li class="bg_lb"> <a href="#"> <i class="icon-envelope-alt"></i>icon-mail </a> </li>
              <li class="bg_lg"> <a href="#"> <i class="icon-dashboard"></i> icon-Dashboard </a> </li>
              <li class="bg_lo"> <a href="#"> <i class="icon-facetime-video"></i>icon-facetime-video </a> </li>
              <li class="bg_ly"> <a href="#"> <i class="icon-external-link"></i> icon-external-link </a> </li>
              <li class="bg_lg"> <a href="#"> <i class="icon-folder-open"></i>icon-folder-open </a> </li>
            </ul>
            <pre class="prettyprint linenums">&lt;ul class="quick-actions"&gt;
              &lt;li a href="#"&gt; &lt;i class="icon-book"&gt;&lt;/i&gt; icon-book &lt;/a&gt; &lt;/li&gt; <br/>&lt;/ul&gt;</pre>
          </div>
        </div>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
            <h5>Different Bars</h5>
          </div>
          <div class="widget-content">
            <div class="progress progress-info">
              <div class="bar" style="width: 20%"></div>
            </div>
            <div class="progress progress-success">
              <div class="bar" style="width: 40%"></div>
            </div>
            <div class="progress progress-warning">
              <div class="bar" style="width: 60%"></div>
            </div>
            <div class="progress progress-danger">
              <div class="bar" style="width: 80%"></div>
            </div>
            <pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"progress"</span><span class="tag">&gt;</span></li><li class="L1"><span class="pln"> </span><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"bar"</span><span class="pln"> </span><span class="atn">style</span><span class="pun">=</span><span class="atv">"</span><span class="pln">width</span><span class="pun">:</span><span class="pln"> </span><span class="lit">difine</span><span class="pun">%;</span><span class="atv">"</span><span class="tag">&gt;&lt;/div&gt;</span></li><li class="L2"><span class="tag">&lt;/div&gt;</span></li></ol>
</pre>
            <div class="progress progress-striped">
              <div class="bar" style="width: 60%;"></div>
            </div>
            <div class="progress progress-striped progress-success">
              <div class="bar" style="width: 60%;"></div>
            </div>
            <div class="progress progress-striped progress-warning">
              <div class="bar" style="width: 60%;"></div>
            </div>
            <div class="progress progress-striped progress-danger">
              <div class="bar" style="width: 60%;"></div>
            </div>
            <pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"progress progress-striped"</span><span class="tag">&gt;</span></li><li class="L1"><span class="pln"> </span><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"bar"</span><span class="pln"> </span><span class="atn">style</span><span class="pun">=</span><span class="atv">"</span><span class="pln">width</span><span class="pun">:</span><span class="pln"> </span><span class="lit">60</span><span class="pun">%;</span><span class="atv">"</span><span class="tag">&gt;&lt;/div&gt;</span></li><li class="L2"><span class="tag">&lt;/div&gt;</span></li></ol>
</pre>
            <div class="progress progress-striped active">
              <div class="bar" style="width: 60%;"></div>
            </div>
            <div class="progress progress-striped progress-success active">
              <div class="bar" style="width: 60%;"></div>
            </div>
            <div class="progress progress-striped progress-warning active">
              <div class="bar" style="width: 60%;"></div>
            </div>
            <div class="progress progress-striped progress-danger active">
              <div class="bar" style="width: 60%;"></div>
            </div>
            <pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"progress progress-striped active"</span><span class="tag">&gt;</span></li><li class="L1"><span class="pln"> </span><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"bar"</span><span class="pln"> </span><span class="atn">style</span><span class="pun">=</span><span class="atv">"</span><span class="pln">width</span><span class="pun">:</span><span class="pln"> </span><span class="lit">60</span><span class="pun">%;</span><span class="atv">"</span><span class="tag">&gt;&lt;/div&gt;</span></li><li class="L2"><span class="tag">&lt;/div&gt;</span></li></ol>
</pre>
            <div class="progress">
              <div class="bar bar-success" style="width: 35%;"></div>
              <div class="bar bar-warning" style="width: 20%;"></div>
              <div class="bar bar-danger" style="width: 10%;"></div>
            </div>
            <pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"progress"</span><span class="tag">&gt;</span></li><li class="L1"><span class="pln"> </span><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"bar bar-success"</span><span class="pln"> </span><span class="atn">style</span><span class="pun">=</span><span class="atv">"</span><span class="pln">width</span><span class="pun">:</span><span class="pln"> </span><span class="lit">35</span><span class="pun">%;</span><span class="atv">"</span><span class="tag">&gt;&lt;/div&gt;</span></li><li class="L2"><span class="pln"> </span><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"bar bar-warning"</span><span class="pln"> </span><span class="atn">style</span><span class="pun">=</span><span class="atv">"</span><span class="pln">width</span><span class="pun">:</span><span class="pln"> </span><span class="lit">20</span><span class="pun">%;</span><span class="atv">"</span><span class="tag">&gt;&lt;/div&gt;</span></li><li class="L3"><span class="pln"> </span><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"bar bar-danger"</span><span class="pln"> </span><span class="atn">style</span><span class="pun">=</span><span class="atv">"</span><span class="pln">width</span><span class="pun">:</span><span class="pln"> </span><span class="lit">10</span><span class="pun">%;</span><span class="atv">"</span><span class="tag">&gt;&lt;/div&gt;</span></li><li class="L4"><span class="tag">&lt;/div&gt;</span></li></ol>
</pre>
          </div>
        </div>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-hand-right"></i> </span>
            <h5>Pop-up dialogs</h5>
          </div>
          <div class="widget-content"> <a href="#myModal" data-toggle="modal" class="btn btn-success">View Popup</a> <a href="#myAlert" data-toggle="modal" class="btn btn-warning">Alert</a> <a href="#myModal2" data-toggle="modal" class="btn btn-info">image Popup</a>
            <div id="myModal" class="modal hide">
              <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h3>Pop up Header</h3>
              </div>
              <div class="modal-body">
                <p>Here is the text coming you can put also image if you want…</p>
              </div>
            </div>
            <div id="myModal2" class="modal hide">
              <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h3>Alert modal</h3>
              </div>
              <div class="modal-body">
                <p><img src="{{ asset('/images/backend_images/gallery/imgbox3.jpg') }}"/></p>
              </div>
              <div class="modal-footer"><a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a> </div>
            </div>
            <div id="myAlert" class="modal hide">
              <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h3>Alert modal</h3>
              </div>
              <div class="modal-body">
                <p>Lorem ipsum dolor sit amet...</p>
              </div>
              <div class="modal-footer"> <a data-dismiss="modal" class="btn btn-primary" href="#">Confirm</a> <a data-dismiss="modal" class="btn" href="#">Cancel</a> </div>
            </div>
          </div>
        </div>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-hand-right"></i> </span>
            <h5>Tooltip directions</h5>
          </div>
          <div class="widget-content">
            <p>Four directions of the tooltips, just add a class: 'tip-top', 'tip-bottom', 'tip-left' or 'tip-right' without quotes to the element you want to have tooltip.</p>
            <p>
              <button class="btn tip-top" data-original-title="Tooltip in top">Top</button>
              <button class="btn tip-left" data-original-title="Tooltip in left">Left</button>
              <button class="btn tip-right" data-original-title="Tooltip in right">Right</button>
              <button class="btn tip-bottom" data-original-title="Tooltip in bottom">Bottom</button>
            </p>
          </div>
        </div>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-hand-right"></i> </span>
            <h5>Pagination</h5>
          </div>
          <div class="widget-content">
            <h3>Default pagination</h3>
            <div class="pagination">
              <ul>
                <li><a href="#">Prev</a></li>
                <li class="active"> <a href="#">1</a> </li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">Next</a></li>
              </ul>
            </div>
            <h3>Alternate pagination</h3>
            <code>&lt;div class="pagination alternate"&gt;</code>
            <div class="pagination alternate">
              <ul>
                <li class="disabled"><a href="#">Prev</a></li>
                <li class="active"> <a href="#">1</a> </li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">Next</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-hand-right"></i> </span>
            <h5>Typography</h5>
          </div>
          <div class="widget-content">
            <div class="bs-docs-example">
              <h1>h1. Heading 1</h1>
              <h2>h2. Heading 2</h2>
              <h3>h3. Heading 3</h3>
              <h4>h4. Heading 4</h4>
              <h5>h5. Heading 5</h5>
              <h6>h6. Heading 6</h6>
            </div>
          </div>
        </div>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-hand-right"></i> </span>
            <h5>Popover Option</h5>
          </div>
          <div class="widget-content">
            <ul class="bs-docs-tooltip-examples">
              <li><a title="" id="example" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-placement="top" data-toggle="popover" class="btn btn-success" href="" data-original-title="Popover on top">Popover on top</a> </li>
              <li><a title="" id="example2" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-placement="right" data-toggle="popover" class="btn btn-success" href="" data-original-title="Popover on right">Popover on right</a> </li>
              <li><a title="" id="example3" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-placement="bottom" data-toggle="popover" class="btn btn-success" href="" data-original-title="Popover on bottom">Popover on bottom</a> </li>
              <li><a title="" id="example4" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-placement="left" data-toggle="popover" class="btn btn-success" href="" data-original-title="Popover on left">Popover on left</a> </li>
            </ul>
          </div>
        </div>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-hand-right"></i> </span>
            <h5>Notifications</h5>
          </div>
          <div class="widget-content">
            <div class="alert alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Warning!</h4>
              You're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. </div>
            <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>
              Tou're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. </div>
            <div class="alert alert-info alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Info!</h4>
              Tou're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. </div>
            <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              You're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. </div>
            <div class="alert">
              <button class="close" data-dismiss="alert">×</button>
              <strong>Warning!</strong> Praesent commodo cursus magna, vel scelerisque nisl consectetur et. </div>
            <div class="alert alert-success">
              <button class="close" data-dismiss="alert">×</button>
              <strong>Success!</strong> Libero, a pharetra augue. Praesent commodo</div>
            <div class="alert alert-info">
              <button class="close" data-dismiss="alert">×</button>
              <strong>Info!</strong> you're not looking too good. </div>
            <div class="alert alert-error">
              <button class="close" data-dismiss="alert">×</button>
              <strong>Error!</strong> Nulla vitae elit libero, a pharetra augue. Praesent commodo </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end-main-container-part-->
@endsection