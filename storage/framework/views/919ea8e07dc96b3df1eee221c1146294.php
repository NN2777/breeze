<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <?php echo e(__('Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="card mt-5">
            <div class="card-body text-center">
              <input id="nameclass" type="text" value="<?php echo e($fungsi->function_name); ?>"> 
            </div>
            <div class="card-body">
              <div id="flowchart" style="text-align: center;"></div>
            </div>
            <div class="card-body">
              <div id="contextMenu"></div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="card mt-5">
              <div class="card-body">
                <div style="position: relative; padding: 2rem 0 0.5rem 0; border-style: solid; border-color: black">
                    <div id="edit" style="text-align: center;"></div>
                </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="card mt-2">
              <div class="card-body text-right">
                <p id="ling">DONWLOAD</p>
              </div>
              <div class="card-body">
                <p id="codearea"></p>
                <ul id="item-list"></u>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="card mt-2">
              <div class="card-body text-center">
                <div class="row">
                <a href="<?php echo e(route('show.page', ['userid' => auth()->id(), 'taskid' => $answer->task_id])); ?>">
                  <button type="button" class="btn btn-secondary" style="background-color:#6C757D;width:80%;text-align:left">
                  Main
                  </button>
                </a>
                <table class="table">
                  <tbody>
                    <tr>
                    </tr>
                    <?php $__currentLoopData = $fungsiAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $func): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td>
                  <a href="<?php echo e(route('fungsi.index', ['id' => $func->id])); ?>">
                    <button type="button" class="btn btn-secondary" style="background-color:#6C757D;text-align:left">
                      <?php echo e($func->function_name); ?>

                    </button>
                  </a></td>
                      <td><a href="<?php echo e(route('fungsi.delete', ['id' => $func->id])); ?>">
                    <button type="button" class="btn btn-secondary" style="background-color:#6C757D;text-align:left">
                      -
                    </button>
                  </a>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                    </tr>
                </tbody>
                </table>
                <!-- <div class="col">
                  <div class="my-column">
                  <?php $__currentLoopData = $fungsiAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $func): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <a href="<?php echo e(route('fungsi.index', ['id' => $func->id])); ?>">
                    <button type="button" class="btn btn-secondary" style="background-color:#6C757D;width:100%;text-align:left">
                      <?php echo e($func->function_name); ?>

                    </button>
                  </a>
                  </div>
                </div>
                <div class="col">
                  <div class="my-column">
                  <a href="<?php echo e(route('fungsi.delete', ['id' => $func->id])); ?>">
                    <button type="button" class="btn btn-secondary" style="background-color:#6C757D;width:100%;text-align:left">
                      -
                    </button>
                  </a>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                </div> -->
                <a href="<?php echo e(route('fungsi.create', ['id' => $answer->id])); ?>">
                  <button type="button" class="btn btn-secondary text-center" style="background-color:#6C757D;width:80%;text-align:left">
                    +
                  </button>
                </a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<script>
 
$(document).ready(function(){

  refresh();

});

function refresh(){
  let getelement = [];
  let element = [];
  let listjavacode = [];
  $.ajax({
    url: '<?php echo e(route("fungsi.data", ["id" => $fungsi->id])); ?>',
    type: 'GET',
    success: function(response) {
        getelement = response.data;
        if (getelement) {
          element.splice(0, 0, ...JSON.parse(getelement));
        }
        codeBox(listjavacode, element);
        console.log(listjavacode);
        generateFlowchart(element);
        genInputBox(element, null, null);
        // translate(listjavacode);
        change(element);
        delete2(element);
    },
    error: function(xhr) {
        console.log(xhr.responseText);
    }
  });
}

function updateValueInArray(data, branch, id, parent, property, newValue) {
  let select = data[parent - 1];
  for (let i = 0; i < branch.length; i++) {
    const currentBranch = branch[i];
    const currentId = id[i] - 1;
    console.log(currentId, currentBranch)
    select = select[currentBranch][currentId];
    console.log(select);
  }

  select[property] = newValue;
}

function selectNodeById(data, id) {
  for (const node of data) {
    if (node.id === id) {
      return node;
    }
    if (node.TrueBranch) {
      const trueBranchNode = selectNodeById(node.TrueBranch, id);
      if (trueBranchNode) {
        return trueBranchNode;
      }
    }
    if (node.FalseBranch) {
      const falseBranchNode = selectNodeById(node.FalseBranch, id);
      if (falseBranchNode) {
        return falseBranchNode;
      }
    }
  }
  return null; // Node with the given ID not found
}

function translateIds(node, parentId = null, branchName = null, isOutermost = true) {
  const newNode = { ...node };

  const nodeId = newNode.id;
  const nodeType = newNode.nodetype;

  // Update the ID of the current node
  if (!isOutermost && parentId) {
    newNode.id = `${branchName}_${parentId}_${nodeId}`;
  } else {
    newNode.id = branchName ? `${branchName}_${nodeId}` : `${nodeId}`;
  }

  // Update the IDs of nested branches
  if (newNode.TrueBranch) {
    const trueBranch = newNode.TrueBranch;
    newNode.TrueBranch = trueBranch.map((innerNode) =>
      translateIds(innerNode, newNode.id, "TrueBranch", false)
    );
  }

  if (newNode.FalseBranch) {
    const falseBranch = newNode.FalseBranch;
    newNode.FalseBranch = falseBranch.map((innerNode) =>
      translateIds(innerNode, newNode.id, "FalseBranch", false)
    );
  }

  return newNode;
}

function translateIdsInData(data) {
  return data.map((node) => translateIds(node));
}

function codeBox(code, element){
  getMain().then(function(response) {
    var data = response.data;
    addline(code, 'public class ' + response.name_class +'(){', 0);
    if(hasInput(data) == true){
      addline(code, 'static Scanner scanner = new Scanner(System.in);', 1);
    }
    addline(code, 'public static void main (String args[]){', 1);
    rule2code(code, JSON.parse(data), 2);  
    addline(code, '}', 1)  
    getgetFungsi(code);
  }).catch(function(error) {
    console.log(error); // Handle any errors  
  });
}

function getMain(){
  return $.ajax({
    url: "<?php echo e(route('answer.data', ['id' => $answer->id] )); ?>",
    type: "GET"
  });
}

function getFungsi(){
  return $.ajax({
    url: "<?php echo e(route('getAllFungsi', ['id' => $answer->id] )); ?>",
    type: "GET"
  });
}

function getgetFungsi(code){
  getFungsi().then(function(response) {
    var data = response.map(function(item) {
      return item;
    });
    for (let index = 0; index < data.length; index++) {
      addline(code, 'public static ' + data[index].function_type + " " + data[index].function_name + '(){', 1);
      rule2code(code, JSON.parse(data[index].data), 2);  
      addline(code, '}', 1)  
    }
    addline(code, '}', 0);
    translate(code);
  }).catch(function(error) {
    console.log(error); // Handle any errors  
  });
}

function rule2code(code, element, indent){
  for (let index = 0; index < element.length; index++) {
    var object = element[index];
    // console.log(object);
    switch (object.nodetype) {
    case "Declare":
      addline(code, object.dtype + " " + object.name + ";", indent);
      break;
    case "Return":
      if(element[0].type != "void"){
        addline(code, "return " + object.value + ";", indent);
      }
      break;
    case "Assign":
      addline(code, object.name + " = " + object.value + ";", indent);
      break;
    case "Input":
      addline(code, "System.out.println("+ "'" + object.prompt + " " + object.name + "'" + ");", indent);
      addline(code, readFunction(element, object), indent);
      break;
    case "Output":
      addline(code ,"System.out.println("+ "'" + object.prompt + "'" +");", indent);
      break;
    case "Selection":
      addline(code, "if(" + object.variable + " " + object.operator + " " + object.value + "){", indent);
      rule2code(code, object.TrueBranch, indent + 1);
      addline(code, "} else { ", indent);
      rule2code(code, object.FalseBranch, indent + 1);
      addline(code, "}", indent);
      break;
    case "Looping":
      addline(code, "for(" + object.counter + " = " + object.start + ", " + object.counter + " " + object.operator + " " + object.condition + ", " + object.counter + object.increment + "){", indent);
      rule2code(code, object.TrueBranch, indent + 1);
      addline(code, "}", indent);
      break;
    default:
      // console.log("dongo");
    }
  }
}

function translate(listjavacode){
    $("#item-list").empty(); // Empty the item-list container
    $.each(listjavacode, function(index, listjavacode) {
      var listItem = $("<pre>").text(listjavacode.code)
      listItem.attr('id', listjavacode.line)
      $("#item-list").append(listItem);
      });
    $(".prompt-area").hide();
}

function genInputBox(element, parent=null, branch=null){
  $.each(element, function (index, item) {
          var div;
          if(!branch && !parent){
            div = $('<div>').attr('class', 'prompt-area').attr('id', item.id);
          }else {
            div = $('<div>').attr('class', 'prompt-area').attr('id', branch + "_" + parent + "_" + item.id);
          }
          if (item.nodetype === 'Declare') {
              $('<input>').attr('type', 'text').attr('name', 'name').attr('class', 'flowchart-input').val(item.name).appendTo(div);
              $('<input>').attr('type', 'text').attr('name', 'dtype').attr('class', 'flowchart-input').val(item.dtype).appendTo(div);
              $('<button>').attr('type', 'button').attr('name', 'delete').attr('class', 'flowchart-delete').text("DELETE").appendTo(div);
          } else if (item.nodetype === 'Assign') {
              $('<input>').attr('type', 'text').attr('name', 'name').attr('class', 'flowchart-input').val(item.name).appendTo(div);
              $('<input>').attr('type', 'text').attr('name', 'value').attr('class', 'flowchart-input').val(item.value).appendTo(div);
              $('<button>').attr('type', 'button').attr('name', 'delete').attr('class', 'flowchart-delete').text("DELETE").appendTo(div);
          } else if (item.nodetype === 'Function') {
              $('<input>').attr('type', 'text').attr('name', 'name').attr('class', 'flowchart-input').val(item.name).appendTo(div);
              $('<input>').attr('type', 'text').attr('name', 'type').attr('class', 'flowchart-input').val(item.type).appendTo(div);
              $('<button>').attr('type', 'button').attr('name', 'delete').attr('class', 'flowchart-delete').text("DELETE").appendTo(div);
          } else if (item.nodetype === 'Return') {
              $('<input>').attr('type', 'text').attr('name', 'value').attr('class', 'flowchart-input').val(item.value).appendTo(div);
              $('<button>').attr('type', 'button').attr('name', 'delete').attr('class', 'flowchart-delete').text("DELETE").appendTo(div);
          } else if (item.nodetype === 'Input') {
              $('<input>').attr('type', 'text').attr('name', 'name').attr('class', 'flowchart-input').val(item.name).appendTo(div);
              $('<input>').attr('type', 'text').attr('name', 'prompt').attr('class', 'flowchart-input').val(item.prompt).appendTo(div);
              $('<button>').attr('type', 'button').attr('name', 'delete').attr('class', 'flowchart-delete').text("DELETE").appendTo(div);
          } else if (item.nodetype === 'Output') {
              $('<input>').attr('type', 'text').attr('name', 'prompt').attr('class', 'flowchart-input').val(item.prompt).appendTo(div);
              $('<button>').attr('type', 'button').attr('name', 'delete').attr('class', 'flowchart-delete').text("DELETE").appendTo(div);
          } else if (item.nodetype === 'Selection') {
              $('<input>').attr('type', 'text').attr('name', 'variable').attr('class', 'flowchart-input').val(item.variable).appendTo(div);
              $('<input>').attr('type', 'text').attr('name', 'operator').attr('class', 'flowchart-input').val(item.operator).appendTo(div);
              $('<input>').attr('type', 'text').attr('name', 'value').attr('class', 'flowchart-input').val(item.value).appendTo(div);
              $('<button>').attr('type', 'button').attr('name', 'delete').attr('class', 'flowchart-delete').text("DELETE").appendTo(div);
              var thisparent;
              if(!branch && !parent){
                thisparent = item.id;
              }else {
                thisparent = branch + "_" + parent + "_" + item.id;
              }
              genInputBox(item.TrueBranch, thisparent, "TrueBranch");
              genInputBox(item.FalseBranch, thisparent, "FalseBranch");
          } else if (item.nodetype === 'Looping') {
              $('<input>').attr('type', 'text').attr('name', 'counter').attr('class', 'flowchart-input').val(item.counter).appendTo(div);
              $('<input>').attr('type', 'text').attr('name', 'start').attr('class', 'flowchart-input').val(item.start).appendTo(div);
              $('<input>').attr('type', 'text').attr('name', 'condition').attr('class', 'flowchart-input').val(item.condition).appendTo(div);
              $('<input>').attr('type', 'text').attr('name', 'operator').attr('class', 'flowchart-input').val(item.operator).appendTo(div);
              $('<input>').attr('type', 'text').attr('name', 'increment').attr('class', 'flowchart-input').val(item.increment).appendTo(div);
              $('<button>').attr('type', 'button').attr('name', 'delete').attr('class', 'flowchart-delete').text("DELETE").appendTo(div);
              var thisparent;
              if(!branch && !parent){
                thisparent = item.id;
              }else {
                thisparent = branch + "_" + parent + "_" + item.id;
              }
              genInputBox(item.TrueBranch, thisparent, "TrueBranch");
              genInputBox(item.FalseBranch, thisparent, "FalseBranch");
          } else if (item.nodetype === 'End') {
              $('<input>').attr('type', 'text').attr('name', 'prompt').attr('class', 'flowchart-input').val('ini end woy').appendTo(div);
          }
          $('#edit').append(div);
        });
}

function splitId(id) {
  var midIndex = Math.floor(id.length / 2);

  var branch = id.slice(0, midIndex);
  var parent = id[midIndex];
  var idName = id.slice(midIndex + 1);

  return {
    branch: branch,
    parent: parent,
    idName: idName
  };
}

function change(element){
  $('input[class="flowchart-input"]').on('change', function() {
    var dataId = $(this).parent().attr('id'); // Get the data ID from a data attribute or any other source
    var property = $(this).attr('name'); // Get the property name from a data attribute or any other source
    var value = $(this).val(); // Get the updated value
    var dataIdSplit = splitId(dataId.split("_"));
    var element2 = element;
    updateValueInArray(element, dataIdSplit.branch.reverse(), dataIdSplit.idName, dataIdSplit.parent, property, value);

    $.ajax({
        url: '<?php echo e(route("fungsi.updatedata", ["id" => $fungsi->id])); ?>',
        type: 'POST',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            element: element2,
        },
        success: function(response) {
           refresh()
        },
        error: function(xhr, status, error) {
            console.log(error.response);
        }
    });
});
}

function delete2(element){
  $('button[class="flowchart-delete"]').on('click', function() {
    var dataId = $(this).parent().attr('id'); // Get the data ID from a data attribute or any other source
    var property = $(this).attr('name'); // Get the property name from a data attribute or any other source
    var value = $(this).val(); // Get the updated value
    var dataIdSplit = splitId(dataId.split("_"));
    // console.log(dataIdSplit.branch.length, dataIdSplit.idName.length, dataIdSplit.parent);
    if(dataIdSplit.branch.length == 0){
      deleteData(element, dataIdSplit.parent);
    } else {
      findtheArraytoDel(element, dataIdSplit.branch.reverse(), dataIdSplit.idName, dataIdSplit.parent);
    }
    var jsonData = element;
    $.ajax({
              url: '<?php echo e(route("fungsi.del.jsondata", ["id" => $fungsi->id])); ?>',
              type: 'POST',              
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              dataType: 'json',
              data: {
                  jsonData: jsonData
              },
              success: function(response) {
                  // Handle the success response
                  console.log(response.data);                  
                  refresh();
              },
              error: function(xhr) {
                  // Handle the error response
                  console.log(xhr.responseText);
              }
          });
});
}

function findtheArraytoDel(data, branch, id, parent){
  let select = data[parent - 1];
  for (let i = 0; i < branch.length; i++) {
    const currentBranch = branch[i];
    const currentId = id[i] - 1;
    if(i == branch.length - 1){
      select = select[currentBranch];
    } else {
      select = select[currentBranch][currentId];
    }
  }
  deleteData(select, id[id.length - 1]);
}

function deleteData(dataArray, position) {
  if (position >= 0 && position < dataArray.length) {
    // Remove the data at the specified position
    dataArray.splice(position - 1, 1);

    // Decrement the IDs of the existing data items after the deleted position
    for (var i = position - 1; i < dataArray.length; i++) {
      dataArray[i].id = (parseInt(dataArray[i].id) - 1).toString();
    }
  }
}

function addline(array, statement, indent){
  let codes;
  if(statement==null){
    codes = null;
  }else{
    const indentStr = '   '.repeat(indent);
    codes = indentStr + statement;
  }

  let line = {
    line: array.length + 1,
    code: codes,
  };

  // console.log(line);
  array.push(line);
}

function hasInput(array) {
  for (let i = 0; i < array.length; i++) {
    if (array[i].nodetype == 'Input') {
      return true;
      break;
    }
  }
  return false;
}

function readFunction(element, object){
  let name; 
  let dtype;
  let scanner;
  for (let index = 0; index < element.length; index++) {
    if(element[index].nodetype == "Declare" && element[index].name == object.name){
      name = element[index].name;
      dtype = element[index].dtype;
      switch (dtype) {
        case "int":
          scanner = "scanner.nextInt()";
          break;
        case "real":
          scanner = "scanner.nextDouble()";
          break;
        case "boolean":
          scanner = "scanner.nextBoolean()";
          break;
        case "char":
          scanner = "scanner.next().charAt(1)";
          break;
        case "String":
          scanner = "scanner.nextLine()";
          break;
        default:
          console.log("I don't know what fruit this is.");
          break;
      }
    }else{
      continue;
    }
    break;

  }
  let line = name + " = " + scanner + ";";
  return line;
}

function searchshape(element, id){
    var data;
    var dataIdSplit = splitId(id.split("_"));
    // console.log(dataIdSplit.branch.length, dataIdSplit.idName.length, dataIdSplit.parent);
    if(dataIdSplit.branch.length == 0){
      data = element[dataIdSplit.parent - 1];
    } else {
      // findtheArraytoDel(element, dataIdSplit.branch.reverse(), dataIdSplit.idName, dataIdSplit.parent);
      data = selectValue(element, dataIdSplit.branch.reverse(), dataIdSplit.idName, dataIdSplit.parent);
    }
    var nodetype = data.nodetype;
    return nodetype;
}

function defaultData(nodetype){
  var data;
  if(nodetype == 'Declare'){
    data = {
    "nodetype": "Declare",
    "name": "x",
    "dtype": "String"};
  } 
  else if(nodetype == 'Input'){
    data = {
    "nodetype": "Input",
    "name": "x",
    "prompt": "Masukkan Nilai"};
  }
  else if(nodetype == 'Function'){
    data = {
    "nodetype": "Function",
    "name": "func"};
  }
  else if(nodetype == 'Assign'){
    data = {
    "nodetype": "Assign",
    "name": "x",
    "value": "10"};
  }  
  else if(nodetype == 'Output'){
    data = {
    "nodetype": "Output",
    "prompt": "x = 19"};
  }
  else if(nodetype == 'Selection'){
    data = {
    "variable":"x",
    "operator":"==",
    "value":"10",
    "nodetype":"Selection",
    "TrueBranch" : [
      {
        "id":"1",
        "nodetype": "Declare",
        "name": "p",
        "dtype": "String"
      },
    ],
    "FalseBranch" : [
      { 
        "id":"1",
        "nodetype": "Declare",
        "name": "p",
        "dtype": "String"
      },
    ]
    };
  }
  else if(nodetype == 'Looping'){
    data = {
      "counter":"i", 
      "start":"0",
      "condition":"10", 
      "operator":"<=", 
      "nodetype":"Looping",
      "increment":"++",
      "TrueBranch" : [
      {
        "id":"1",
        "nodetype": "Declare",
        "name": "loop",
        "dtype": "String"
      },
      ],
      "FalseBranch" : [
        {
          "id":"1",
          "nodetype": "Declare",
          "name": "loop",
          "dtype": "String"
        },
      ]
    };
  } else {

  }
  
  return data;
}


function findtheArray(data, branch, id, parent, newValue) {
  let select = data[parent - 1];
  for (let i = 0; i < branch.length; i++) {
    const currentBranch = branch[i];
    const currentId = id[i] - 1;
    if(i == branch.length - 1){
      select = select[currentBranch];
    } else {
      select = select[currentBranch][currentId];
    }
  }
  addNewData(select, newValue, id[id.length - 1]);
}

function addNewData(dataArray, newData, position) {
  console.log(dataArray, newData, position);
  if (position === dataArray.length) {
    // Set the new ID for the new data
    newData.id = (dataArray.length + 1).toString();

    // Add the new data at the end of the array
    dataArray.push(newData);
  } else {
    // Increment the IDs of the existing data items after the specified position
    for (var i = position; i < dataArray.length; i++) {
      dataArray[i].id = (parseInt(dataArray[i].id) + 1).toString();
    }

    // Set the new ID for the new data
    newData.id = (parseInt(position) + 1).toString();

    // Insert the new data at the specified position
    dataArray.splice(position, 0, newData);
  }
}


function incrementId(item) {
  item.id = (parseInt(item.id) + 1).toString();

  if (item.TrueBranch) {
    for (var i = 0; i < item.TrueBranch.length; i++) {
      incrementId(item.TrueBranch[i]);
    }
  }

  if (item.FalseBranch) {
    incrementId(item.FalseBranch);
  }
}

function showeditmenu(title){
    $(".prompt-area").hide();
    $("#" + title).show();
}

function selectValue(element, branch, id, parent){
  let select = element[parent - 1];
  for (let i = 0; i < branch.length; i++) {
    const currentBranch = branch[i];
    const currentId = id[i] - 1;
    select = select[currentBranch][currentId];
  }
  return select;
}

function nodeDot(element) {
    nodes = d3.selectAll('.node');
    nodes
        .on("click", function () {
          var mouseButton = d3.event.button; 
          // console.log(mouseButton);
            if (mouseButton === 0) {
              var title = d3.select(this).selectAll('title').text();
              var text = d3.select(this).selectAll('text').text();
              var id = d3.select(this).attr('id');
              var class1 = d3.select(this).attr('class');
              console.log(title);
              var nodetype = searchshape(element, title);
              console.log('Element id="%s" class="%s" title="%s" text="%s" nodetype="%s"', id, class1, title, text, nodetype);
              showeditmenu(title);
            }else if(mouseButton === 2){
              console.log("coy");
            }
        });
}
    
function edgeDot(element) {
    var edges = d3.selectAll('.edge');
    
    edges.on("click", function() {
        // Prevent the default context menu from appearing
        d3.event.preventDefault();
        
        // Check if it was a left mouse button click (event.button === 0)
        if (d3.event.button === 0) {
            var id = d3.select(this).attr('id'); 
            var class1 = d3.select(this).attr('class');
            var label = d3.select(this).selectAll('text').text();
            console.log('Element id="%s" class="%s" label="%s"', id, class1, label);
            
            // Calculate the position of the context menu
            var posX = d3.event.pageX;
            var posY = d3.event.pageY;
            
            // Show the context menu at the calculated position
            showContextMenu(posX, posY, id, class1, label, element);

            d3.event.stopPropagation();
        }
    });

    d3.select(document).on("click", function () {
        // Hide the context menu
        hideContextMenu();
    });
    
}

function hideContextMenu() {
    // Hide the context menu
    var contextMenu = d3.select('#contextMenu');
    contextMenu.style('display', 'none');
}

function all(element){
  nodeDot(element);
  edgeDot(element);
}

function showContextMenu(posX, posY, id, class1, label, element) {
    // Create or show the context menu element
    var contextMenu = d3.select('#contextMenu');
    
    // Update the content or behavior of the context menu as needed
    contextMenu.html('');
    contextMenu.append('div').text('Declare').attr('class', 'contextMenu');
    contextMenu.append('div').text('Assign').attr('class', 'contextMenu');
    contextMenu.append('div').text('Input').attr('class', 'contextMenu');
    contextMenu.append('div').text('Output').attr('class', 'contextMenu');
    contextMenu.append('div').text('Selection').attr('class', 'contextMenu');
    contextMenu.append('div').text('Looping').attr('class', 'contextMenu');
    contextMenu.append('div').text('Function').attr('class', 'contextMenu');

    contextMenu.selectAll('.contextMenu')
        .on('click', function() {
            var menuItem = d3.select(this).text();
            // Perform some action based on the clicked menu item
            console.log('Clicked on:', menuItem);

            var data = defaultData(menuItem);
            var dataIdSplit = splitId(label.split("_"));
            console.log(dataIdSplit.branch.length, dataIdSplit.idName.length, dataIdSplit.parent);
            if(dataIdSplit.branch.length == 0){
              addNewData(element, data, dataIdSplit.parent);
            } else {
              findtheArray(element, dataIdSplit.branch.reverse(), dataIdSplit.idName, dataIdSplit.parent, data);
            }

            var jsonData = element;
            // console.log(jsonData);

            $.ajax({
              url: '<?php echo e(route("fungsi.add.jsondata", ["id" => $fungsi->id])); ?>',
              type: 'POST',              
              headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              dataType: 'json',
              data: {
                  jsonData: jsonData
              },
              success: function(response) {
                  // Handle the success response
                  // console.log(response.data);                  
                  refresh();
              },
              error: function(xhr) {
                  // Handle the error response
                  console.log(xhr.responseText);
              }
          });
            
            // Hide the context menu after clicking
            hideContextMenu();
        });
    // Position the context menu at the calculated position
    contextMenu.style('left', posX + 'px')
              .style('top', posY + 'px')
              .style('display', 'block');
}

function attributer(datum, index, nodes) {
    var selection = d3.select(this);
    if (datum.tag == "svg") {
        datum.attributes = {
            ...datum.attributes,
            width: '100%',
            height: '100%',
        };
        // svg is constructed by hpcc-js/wasm, which uses pt instead of px, so need to convert
        const px2pt = 3 / 4;

        // get graph dimensions in px. These can be grabbed from the viewBox of the svg
        // that hpcc-js/wasm generates
        const graphWidth = datum.attributes.viewBox.split(' ')[2] / px2pt;
        const graphHeight = datum.attributes.viewBox.split(' ')[3] / px2pt;

        // new viewBox width and height
        const w = graphWidth / 1;
        const h = graphHeight / 1;

        // new viewBox origin to keep the graph centered
        const x = -(w - graphWidth) / 2;
        const y = -(h - graphHeight) / 2;

        const viewBox = `${x * px2pt} ${y * px2pt} ${w * px2pt} ${h * px2pt}`;
        selection.attr('viewBox', viewBox);
        datum.attributes.viewBox = viewBox;
    }
}

function generateFlowchart(element) {
  // Initialize the graphviz object
  var graphviz = d3.select("#flowchart").graphviz().zoom(false)
    .attributer(attributer);

  // Define the flowchart nodes
  var nodes = [];
  var edges = [];

  var dot = 'digraph { \
        node [shape=box style=filled]; \
        ';

  // Iterate through the array of objects and create nodes based on the nodetype property
  function processElement(element, parent = "", branch = "") {
    for (let index = 0; index < element.length; index++) {
      var obj = element[index];
      var nodeId;
      var prevObj = element[index - 1];
      var prevId;
      var nodetype = obj.nodetype;

      if(parent){
          nodeId = processIdFormat(obj.id, parent, branch);
          prevId = processIdFormat(prevObj?.id, parent, branch);
        } else {
          nodeId = obj.id;
          prevId = prevObj?.id;
        }

      if(obj == element[0]){
        processNode(nodeId, obj, nodetype);
      } else {
        processNode(nodeId, obj, nodetype);
        processEdge(element, prevId, nodeId, prevId);
      }
    }
  }

  function processNode(nodeId, obj, nodetype){
    switch (nodetype) {
        case "Function":
          var label = obj.name + "()";
          nodes.push({ id: nodeId, shape: "circle", label: label });
          break;
        case "Return":
          var label = obj.nodetype + " " + obj.value;
          nodes.push({ id: nodeId, shape: "circle", label: label });
          break;
        case "Start":
          nodes.push({ id: nodeId, shape: "circle", label: "Start" });
          break;
        case "Declare":
          var label = obj.dtype + " " + obj.name;
          nodes.push({ id: nodeId, shape: "hexagon", label: label });
          break;
        case "Assign":
          var label = obj.name + " = " + obj.value;
          nodes.push({ id: nodeId, shape: "rectangle", label: label });
          break;
        case "Input":
          var label = obj.prompt + " " + obj.name;
          nodes.push({ id: nodeId, shape: "parallelogram", label: label });
          break;
        case "Output":
          var label = obj.prompt;
          nodes.push({ id: nodeId, shape: "parallelogram", label: label });
          break;
        case "Selection":
          var label = obj.variable + " " + obj.operator + " " + obj.value;
          nodes.push({ id: nodeId, shape: "diamond", label: label });
          nodes.push({ id: "endif_" + nodeId, shape: "doublecircle", label: "endif" });
          // processNode(nodeId + "_endif", null, "Endif", nodeId);
          
          if (obj.TrueBranch) {
            // Generate nodes for TrueBranch
            processBranchIf(obj.TrueBranch, nodeId, "TrueBranch");
          }

          if (obj.FalseBranch) {
            // Generate nodes for FalseBranch
            processBranchIf(obj.FalseBranch, nodeId, "FalseBranch");
          }
          break;
        case "Looping":
          var label = obj.counter + " = " + obj.start + "; " + obj.counter  + " " + obj.operator + " " + obj.condition +  "; " + obj.counter + obj.increment;
          nodes.push({ id: nodeId, shape: "diamond", label: label });
          nodes.push({ id: "endfor_" + nodeId, shape: "doublecircle", label: "endloop" });
          // processNode(nodeId + "_endif", null, "Endif", nodeId);
          
          if (obj.TrueBranch) {
            // Generate nodes for TrueBranch
            processBranchForTrue(obj.TrueBranch, nodeId, "TrueBranch");
          }

          if (obj.FalseBranch) {
            // Generate nodes for FalseBranch
            processBranchForFalse(obj.FalseBranch, nodeId, "FalseBranch");
          }
          break;
        case "End":
          nodes.push({ id: nodeId, shape: "circle", label: "End" });
          break;
        default:
          break;
      }
  }

  function processEdge(element, from, to, label){
    // console.log(from, to);
    var res = isHaveBranch(element, from); // res = nodetype tapi karena nested id nya itu masih raw kek branch_parent_id nanti pisah dl
    if(res == "Selection"){
      from = "endif_" + from;
      // console.log(from, to);
    }else if(res == "Looping"){
      from = "endfor_" + from;
    }else {
      from = from;
    }
    // console.log(from, to);
    // console.log(res, element, from, to);
    edges.push({ from: from, to: to, label:label });
  }

  function processBranchForTrue(element, parent, branch){
    processEdge(element, parent, processIdFormat(element[0].id, parent, branch), processIdFormat(0, parent, branch));
    processElement(element, parent, branch);
    processEdge(element, processIdFormat(element[element.length - 1].id, parent, branch), "endfor_" + parent, processIdFormat(element.length, parent, branch));
  }

  function processBranchForFalse(element, parent, branch){
    processEdge(element, parent, processIdFormat(element[0].id, parent, branch), processIdFormat(0, parent, branch));
    processElement(element, parent, branch);
    processEdge(element, processIdFormat(element[element.length - 1].id, parent, branch), parent, processIdFormat(element.length, parent, branch));
  }

  function processBranchIf(element, parent, branch){
    // console.log(element, parent, branch);
    processEdge(element, parent, processIdFormat(element[0].id, parent, branch), processIdFormat(0, parent, branch));
    processElement(element, parent, branch);
    processEdge(element, processIdFormat(element[element.length - 1].id, parent, branch), "endif_" + parent, processIdFormat(element.length, parent, branch));
  }

  function processIdFormat(id, parent, branch){
    var parentLabel = "_" + parent;
    var idLabel = "_" + id;
    return branch + parentLabel + idLabel;
  }

  processElement(element);
  // nodes.push({ id: "element_1", shape: "circle", label: "NGAPUS" });
  // Generate the DOT code for the graph

  function isHaveBranch(element, id){
    var nodetype;
    // console.log(id);
    if (isNaN(id)) {
      fromsplit = id.split("_");
      id = fromsplit[fromsplit.length - 1] - 1;
    }else {
      id = id - 1;
    }

    // INI GK BISA IDENTIFY ID BRANCH ATAS

    // console.log(element, id, element[id]);
    if (element[id]?.nodetype == "Selection") {
      nodetype = element[id].nodetype;
    }else if (element[id]?.nodetype == "Looping"){
      nodetype = element[id].nodetype;
    }else {
      nodetype = null;
    }
    return nodetype; //ngembaliin nodetype
  }

  for (var i = 0; i < nodes.length; i++) {
    var node = nodes[i];
    dot += node.id + ' [label="' + node.label + '", shape=' + node.shape + '];\n';
  }

  for (var i = 0; i < edges.length; i++) {
    var edge = edges[i];
    dot += edge.from + ' -> ' + edge.to + ' [label="' + edge.label + '", fontsize=0];\n';
    // dot += edge.from + ' -> ' + edge.to + ' [label="' + edge.label + '"];\n';
  }

  
  dot += '}';

  graphviz
    .renderDot(dot)
    .on("end", function () {
      // Get the SVG code generated by graphviz and set it as the innerHTML of the "flowchart" div
      var svg = document.querySelector("#flowchart svg");
      document.querySelector("#flowchart").innerHTML = "";
      document.querySelector("#flowchart").appendChild(svg);
      all(element);
    });
}

</script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Naufal Nafidiin\Koding\breeze\resources\views/funcshow.blade.php ENDPATH**/ ?>