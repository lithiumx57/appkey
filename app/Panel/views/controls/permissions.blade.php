<?php
$permissions = \App\Panel\helpers\XPermissionHelper::getPermissions();
?>
<div class="form-group">
  <div style="margin: 5px 0 20px;">
    <div style="margin-top: 8px;margin-bottom: 8px">دسترسی ها</div>

    <?php $i = 0; $currentPermission = -1; $lastPermission = 0;?>
    @foreach($permissions as $permission)
      @if($permission->parent != 0) @continue @endif
      <div class="permissionBox col-md-6" style="width:300px;height: 600px">
        @if($permission->parent==0)
          <div class="icheck-material-danger p_parent">
            <input @if(old('permissions')) @foreach(old('permissions') as $old) @if($old==$permission->id) checked @endif  @endforeach @endif onchange="permissionChange(this)" type="checkbox" id="success_{{$permission->id}}" name="permissions[]" value="{{$permission->id}}" class="permission">
            <label style="color: yellow" class="f15" for="success_{{$permission->id}}">{{$permission->label}}</label>
          </div>
          @foreach($permissions as $row)
            @if($row->parent != $permission->id) @continue @endif
            <div style="padding-right: 30px" class="p_child">
              <div class="icheck-material-warning">
                <input @if(old('permissions')) @foreach(old('permissions') as $old) @if($old==$permission->id) checked @endif  @endforeach @endif  onchange="permissionChange(this)" type="checkbox" id="success_{{$row->id}}" name="permissions[]" value="{{$row->id}}" class="permission">
                <label style="font-weight: bold" class="f12" for="success_{{$row->id}}">{{$row->label}}</label>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    @endforeach

  </div>
</div>


<script>


  var permissions = JSON.parse('{!! $permissions !!}');

  @if($object->isEditMode())
  var checkedPermissions = JSON.parse('{!! $record->permissions !!}');

  for (var cp in checkedPermissions) {
    document.getElementById("success_" + checkedPermissions[cp]['id']).setAttribute("checked", "checked")
  }
  @endif

  var permissionTags = document.getElementsByClassName("permission");

  function permissionChange(tag) {
    var checked = tag.checked;
    var id = parseInt(tag.id.replace("success_", ""));
    var permission = getPermission(id);

    if (hasParent(permission)) {
      checkParent(permission, checked)
    } else if (hasChild(permission)) {
      checkChildren(permission, checked)
    }
  }


  function checkChildren(permission, checked) {

    for (var i = 0; i < permissions.length; i++) {
      if (permissions[i].parent === permission.id) {

        var p = getPermission(permissions[i].id);
        var tag = document.getElementById("success_" + p.id);

        if (checked) {
          tag.checked = "checked";
        } else {
          $(tag).prop('checked', false);
        }

      }
    }
  }


  function hasLevelChecked(permission) {
    var p = getPermission(permission.parent)
    var children = getChildren(p.id);

    for (var i = 0; i < children.length; i++) {
      var tag = document.getElementById("success_" + children[i].id);
      if (tag.checked) {
        return true;
      }
    }
    return false;

  }


  function getChildren(permissionId) {
    var c = [];
    for (var i = 0; i < permissions.length; i++) {
      if (permissions[i].parent === permissionId) {
        c.push(permissions[i])
      }
    }
    return c;
  }


  function hasChild(permission) {
    for (var i = 0; i < permissions.length; i++) {
      if (permissions[i].parent === permission.id) {
        return true;
      }
    }
    return false;
  }


  function checkParent(permission) {
    var parent = getPermission(permission.parent);

    var tag = document.getElementById("success_" + parent.id);
    if (hasLevelChecked(permission)) {
      tag.checked = "checked";
    } else {
      $(tag).prop('checked', false);
    }


  }


  function hasParent(permission) {
    return permission.parent !== 0
  }


  function getPermission(id) {
    for (var i = 0; i < permissions.length; i++) {
      var permission = permissions[i];
      if (permission.id === id) {
        return permission;
      }
    }
    return null;
  }


</script>


