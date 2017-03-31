<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
    tinymce.init({ 
      selector:'textarea#abstraction',
      plugins : 'anchor advlist autolink link image media imagetools lists charmap print preview autosave autoresize colorpicker fullscreen insertdatetime layer pagebreak save searchreplace table wordcount hr',
      toolbar : 'undo redo | forecolor backcolor | bold italic underline bullist numlist | link image',
      browser_spellcheck: true,
      table_grid: true,
      table_default_attributes: {
        class : 'table table-hover table-condensed table-responsive'
      },
      table_default_styles: {
        height : 'auto',
        width : '100%',
      },
      image_advtab: true,
      image_title: true,
      link_assume_external_targets: true,
      default_link_target: "_blank",
      relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = '/laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x ,
        height : y ,
        resizable : "yes",
        close_previous : "no"
      });
    }
    });
</script>
<style type="text/css">
  

.mce-window                         {max-width:100% !important; top:0px !important; left:0px !important; background:none !important;}
.mce-window-head                    {background:#FFFFFF !important;}
.mce-window-body                    {background:#FFFFFF !important;}
.mce-foot > .mce-container-body     {padding:10px !important; max-width:80% !important;}
.mce-panel                          {max-width:100% !important;}
.mce-container                      {max-width:100% !important; height:auto !important; overflow:auto;}
.mce-container-body                 {max-width:100% !important; height:auto !important; overflow:auto;}
.mce-form                           {padding:10px !important;}
.mce-tabs                           {max-width:100% !important;}
.mce-formitem                       {margin:10px 0 !important;}
.mce-abs-layout-item                {position:static !important; width:auto !important;}
.mce-abs-layout-item.mce-label      {display:block !important;}
.mce-abs-layout-item.mce-textbox    {-webkit-box-sizing:border-box !important; -moz-box-sizing:border-box !important; box-sizing:border-box !important; display:block !important; max-width:100% !important;}
.mce-abs-layout-item.mce-combobox   {display:flex !important;}
.mce-abs-layout-item.mce-combobox > .mce-textbox {-ms-flex:1 1 auto; -webkit-flex:1 1 auto; flex:1 1 auto; height:29px !important; max-width:80% !important;}
.mce-container-body.mce-window-body.mce-abs-layout iframe {height:500px !important;} /*this only use with responsive file manager 9*/

</style>


<div class="box-body">
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
      <label for="title">Problem Title</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Meaning Full Short Title" value="{{ old('title', isset($problem->title) ? $problem->title : null) }}" required>
        @if ($errors->has('title'))
          <span class="help-block">
              <strong>
                  <ul>
                      @foreach ($errors->get('title') as $errorMsg)
                          <li>{{ $errorMsg }}</li>    
                      @endforeach
                  </ul>
              </strong>
          </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
      <label for="category">Select Category</label>
      @if(isset($problem->category_id))
        <input type="text" class="form-control" id="category" name="category" required value="{{ $problem->category->name }} , {{ $problem->category->points }}" disabled>
      @else
        <select class="form-control select2" id="category" name="category" style="width:100%" required>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                @if(old('category') == $category->id)
                  selected="selected" 
                @endif
              >
                {{ $category->name }} , {{ $category->points }}
            </option>
          @endforeach
        </select>
        @if ($errors->has('category'))
          <span class="help-block">
              <strong>
                  <ul>
                      @foreach ($errors->get('category') as $errorMsg)
                          <li>{{ $errorMsg }}</li>    
                      @endforeach
                  </ul>
              </strong>
          </span>
        @endif
      @endif
    </div>
    <div class="form-group{{ $errors->has('abstraction') ? ' has-error' : '' }}">
      <label for="abstraction">Problem Abstraction</label>
      <textarea class="form-control" id="abstraction" name="abstraction" rows="10" required>{{ old('abstraction', isset($problem->abstraction) ? $problem->abstraction : "Whole decsription for the problem here..." ) }}</textarea>
        @if ($errors->has('abstraction'))
          <span class="help-block">
              <strong>
                  <ul>
                      @foreach ($errors->get('abstraction') as $errorMsg)
                          <li>{{ $errorMsg }}</li>    
                      @endforeach
                  </ul>
              </strong>
          </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('minorhint') ? ' has-error' : '' }}">
      <label for="minorhint">MinorHint</label>
      <textarea class="form-control" id="minorhint" name="minorhint" rows="5" placeholder="MinorHint for the problem here..." required>{{ old('minorhint', isset($problem->minorhint) ? $problem->minorhint : null ) }}</textarea>
        @if ($errors->has('minorhint'))
          <span class="help-block">
              <strong>
                  <ul>
                      @foreach ($errors->get('minorhint') as $errorMsg)
                          <li>{{ $errorMsg }}</li>    
                      @endforeach
                  </ul>
              </strong>
          </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('majorhint') ? ' has-error' : '' }}">
      <label for="majorhint">Major Hint</label>
      <textarea class="form-control" id="majorhint" name="majorhint" rows="5" placeholder="MajorHint for the problem here..." required>{{ old('majorhint', isset($problem->majorhint) ? $problem->majorhint : null ) }}</textarea>
        @if ($errors->has('majorhint'))
          <span class="help-block">
              <strong>
                  <ul>
                      @foreach ($errors->get('majorhint') as $errorMsg)
                          <li>{{ $errorMsg }}</li>    
                      @endforeach
                  </ul>
              </strong>
          </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('flag') ? ' has-error' : '' }}">
      <label for="flag">Expected output <i>(FLAG)</i></label>
      <input type="text" class="form-control" id="flag" name="flag" placeholder="Solution of the Problem" value="{{ old('flag', isset($problem->flag) ? $problem->flag : null) }}" required>
        @if ($errors->has('flag'))
          <span class="help-block">
              <strong>
                  <ul>
                      @foreach ($errors->get('flag') as $errorMsg)
                          <li>{{ $errorMsg }}</li>    
                      @endforeach
                  </ul>
              </strong>
          </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('problempageurl') ? ' has-error' : '' }}">
      <label for="problempageurl">Problem Page's URL (optional)</label>
      <input type="text" class="form-control" id="problempageurl" name="problempageurl" placeholder="URL of Problem Page" value="{{ old('problempageurl', isset($problem->problempageurl) ? $problem->problempageurl : null) }}">
        @if ($errors->has('problempageurl'))
          <span class="help-block">
              <strong>
                  <ul>
                      @foreach ($errors->get('problempageurl') as $errorMsg)
                          <li>{{ $errorMsg }}</li>    
                      @endforeach
                  </ul>
              </strong>
          </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('problemfilespath') ? ' has-error' : '' }}">
      <label for="problemfilespath">Downloadable File's Path(optional) <i>To Uplaod a file click<a href="{{ url('/laravel-filemanager?type=Files') }}" target="_blank"  data-toggle="tooltip" data-placement="top" title="Url should be /files/shares/-your-folder/-file-name.-ext"> here <i class="fa fa-info-circle"></i> </a>.</i></label>
      <input type="text" class="form-control" id="problemfilespath" name="problemfilespath" placeholder="Downloadable File's Path" value="{{ old('problemfilespath', isset($problem->problemfilespath) ? $problem->problemfilespath : null) }}">
        @if ($errors->has('problemfilespath'))
          <span class="help-block">
              <strong>
                  <ul>
                      @foreach ($errors->get('problemfilespath') as $errorMsg)
                          <li>{{ $errorMsg }}</li>    
                      @endforeach
                  </ul>
              </strong>
          </span>
        @endif
    </div>
    
  <div class="row">
    <div class="col-sm-4">
      <button type="submit" class="btn btn-success btn-block"><i class="fa fa-plus"> </i> {{ $submitButton }}</button>
    </div>
    <div class="col-sm-4">
      
    </div>
    <div class="col-sm-4">
      <button type="reset" class="btn btn-default btn-block"> Reset Form</button>
    </div>
  </div>
</div>
<!-- /.box-body -->