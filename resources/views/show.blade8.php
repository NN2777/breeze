<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container">
      <div class="card mt-5">
        <div id="clickable">
          Right Click Me!
        </div>

        <ul id="menu">
          <li class="menu-item">Action 1</li>
          <li class="menu-item">Action 2</li>
          <li class="menu-item">Action 3</li>
          <li class="menu-item">Action 4</li>
        </ul>

        <div id="out-click"></div>
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
    url: '{{ route("task.data", ["id" => $task->id]) }}',
    type: 'GET',
    success: function(response) {
        getelement = response.data;
        if (getelement) {
          element.splice(0, 0, ...JSON.parse(getelement));
        }
        // console.log(element);
        // console.log(listjavacode);
        main(listjavacode, element);
        generateFlowchart(element);
        genInputBox(element, null, null);
        translate(listjavacode);
        change();
        // findtheArray(element, "TrueBranch_5_0");
        // console.log(translateData(element));
        // console.log(findObjectById(element, 6));
        // console.log(element);
        // Do something with the data array
    },
    error: function(xhr) {
        console.log(xhr.responseText);
    }
  });
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
          } else if (item.nodetype === 'Input') {
              $('<input>').attr('type', 'text').attr('name', 'name').attr('class', 'flowchart-input').val(item.name).appendTo(div);
              $('<input>').attr('type', 'text').attr('name', 'prompt').attr('class', 'flowchart-input').val(item.prompt).appendTo(div);
          } else if (item.nodetype === 'Output') {
              $('<input>').attr('type', 'text').attr('name', 'prompt').attr('class', 'flowchart-input').val(item.prompt).appendTo(div);
          } else if (item.nodetype === 'Selection') {
              $('<input>').attr('type', 'text').attr('name', 'variable').attr('class', 'flowchart-input').val(item.variable).appendTo(div);
              $('<input>').attr('type', 'text').attr('name', 'operator').attr('class', 'flowchart-input').val(item.operator).appendTo(div);
              $('<input>').attr('type', 'text').attr('name', 'value').attr('class', 'flowchart-input').val(item.value).appendTo(div);
              genInputBox(item.TrueBranch, item.id, "TrueBranch");
              genInputBox(item.FalseBranch, item.id, "FalseBranch");
          } else if (item.nodetype === 'End') {
              $('<input>').attr('type', 'text').attr('name', 'prompt').attr('class', 'flowchart-input').val('ini end woy').appendTo(div);
          }
          $('#edit').append(div);
        });
}

function change(){
  $('input[class="flowchart-input"]').on('change', function() {
    var dataId = $(this).parent().attr('id'); // Get the data ID from a data attribute or any other source
    var property = $(this).attr('name'); // Get the property name from a data attribute or any other source
    var value = $(this).val(); // Get the updated value

    $.ajax({
        url: '/update-data',
        type: 'POST',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            dataId: dataId,
            property: property,
            value: value
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

function addline(array, statement, indent){
  let codes;
  if(statement==null){
    codes = null;addDataToArray
  }else{
    const indentStr = '   '.repeat(indent);
    codes = indentStr + statement;
  }

  let line = {
    line: array.length + 1,
    code: codes,
  };

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

function statement2code(array, object, element){
  indent = 2;
  switch (object.nodetype) {
  case "Declare":
    addline(array, object.dtype + " " + object.name + ";", indent);
    break;
  case "Input":
    addline(array, "System.out.println("+ "'" + object.prompt + " " + object.name + "'" + ");", indent);
    addline(array, readFunction(element, object), indent)
    break;
  case "Output":
    addline(array,"System.out.println("+ "'" + object.prompt + "'" +");", indent);
    break;
  case "Start":
    return null;
    break;
  case "End":
    return null;
    break;
  default:
    // code to execute when none of the above cases match expression
    break;
}
}

function main(code, element){
  addline(code, 'public class myclass(){', 0);
  if(hasInput(element) == true){
    addline(code, 'static Scanner scanner = new Scanner(System.in);', 1);
  }
  addline(code, 'public static void main(String args[]){', 1);
  // while (element.nodetype == 'End') {
  //   addline(translate(statement)) //statement, all different value like prompt or etc from start to end
  // }
  // for (let index = 0; index < element.length; index++) {
  //   addline(code, statement(element[index]), 2)
  // }
  for (let index = 0; index < element.length; index++) {
    statement2code(code, element[index], element);
  }
  addline(code, '}', 1);
  addline(code, '}', 0);

  // console.log(listjavacode);
}

function searchshape(element, parent = null, branch = null, id){
    var nodetype;
    var indexParent = parent - 1;
    var indexId = id - 1
    // console.log(element[indexParent][branch][indexId].nodetype);

    if (branch !== null) {;
      var parentBranch = element[indexParent][branch];
      // console.log(indexParent, branch, parent, id, parentBranch[0], parentBranch[0][indexId]);
      if (parent !== null && element[indexParent] && element[indexParent][branch]) {
        var parentBranch = element[indexParent][branch];
        nodetype = parentBranch[indexId].nodetype;
      }
    } else {
      nodetype = element[indexId].nodetype;
    }
    return nodetype; // Node not found
}

function defaultData(nodetype){
  var data;
  if(nodetype == 'Declare'){
    data = {
    "nodetype": "Declare",
    "name": "x",
    "dtype": "String"};
  } else if(nodetype == 'Input'){
    data = {
    "nodetype": "Input",
    "name": "x",
    "prompt": "Masukkan Nilai"};
  } else if(nodetype == 'Output'){
    data = {
    "nodetype": "Output",
    "prompt": "x = 19"};
  } else {

  }
  
  return data;
}

// function addNewData(dataArray, newData, position) {
//   // Increment the IDs of the existing data items after the specified position
//   for (var i = position; i < dataArray.length; i++) {
//     dataArray[i].id = (parseInt(dataArray[i].id) + 1).toString();
//   }

//   // Set the new ID for the new data
//   newData.id = (position + 1).toString();

//   // Insert the new data at the specified position
//   dataArray.splice(position, 0, newData);
// }
function findtheArray(array, id, newData){
  var idSplit = id.split("_");
  // var parts = title.split("_"); // Split the text string by underscores

  var branch = idSplit[0];
  var parentId = idSplit[1];
  var theId = idSplit[2];
  
  // console.log(array[parentId - 1][branch], branch, parentId, theId);

  if(!parentId && !theId){
    addNewData(array, newData, branch);
    console.log(array);
    // console.log(array[branch - 1]);
  }else {
    // array[parentId - 1][branch];
    data = array[parentId - 1][branch];
    addNewData(data, newData, theId);
    array[parentId - 1][branch] = data;
    console.log(array);
    // console.log(array[parentId - 1][branch]);
  }

  // console.log(data);
  // return data;
  // kalo id[2] ada array = array[id[1]][branch]
  // kalo id[2] kosong array = array;
}

function addNewData(dataArray, newData, position) {
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

// Function to recursively increment the ID of an item and its children
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

function nodeDot(element) {
    nodes = d3.selectAll('.node');
    nodes
        .on("click", function () {
          var mouseButton = d3.event.button; 
          console.log(mouseButton);
            if (mouseButton === 0) {
              var title = d3.select(this).selectAll('title').text();
              var text = d3.select(this).selectAll('text').text();
              var id = d3.select(this).attr('id');
              var class1 = d3.select(this).attr('class');
  
              var parts = title.split("_"); // Split the text string by underscores
              var branch = parts[0]; // "FalseBranch"
              var var1 = parseInt(parts[1]); // 5 (converted to integer)
              var var2 = parseInt(parts[2]); // 0 (converted to integer)
  
              if (isNaN(var1)) {
                var1 = null;
              }
  
              if (isNaN(var2)) {
                var2 = null;
              }
  
              var nodetype;
              console.log(branch, var1, var2);
              if(var1==null & var2==null){
                nodetype = searchshape(element, null, null, branch);
              }else {
                nodetype = searchshape(element, var1, branch, var2);
              }
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
    contextMenu.append('div').text('Input').attr('class', 'contextMenu');
    contextMenu.append('div').text('Output').attr('class', 'contextMenu');
    contextMenu.append('div').text('Selection').attr('class', 'contextMenu');

    contextMenu.selectAll('.contextMenu')
        .on('click', function() {
            var menuItem = d3.select(this).text();
            // Perform some action based on the clicked menu item
            console.log('Clicked on:', menuItem);

            var data = defaultData(menuItem);
            //YANG INI COY
            findtheArray(element, label, data);

            var jsonData = element;

            $.ajax({
              url: '{{ route('add.jsondata') }}',
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
            
            // Hide the context menu after clicking
            hideContextMenu();
        });
    // Position the context menu at the calculated position
    contextMenu.style('left', posX + 'px')
              .style('top', posY + 'px')
              .style('display', 'block');
}

function generateFlowchart(element) {
  // Initialize the graphviz object
  var graphviz = d3.select("#flowchart").graphviz().zoom(false);

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
        case "Start":
          nodes.push({ id: nodeId, shape: "circle", label: "Start" });
          break;
        case "Declare":
          var label = obj.name + " = " + obj.dtype;
          nodes.push({ id: nodeId, shape: "hexagon", label: label });
          break;
        case "Assign":
          var label = obj.name + " = " + obj.dtype;
          nodes.push({ id: nodeId, shape: "hexagon", label: label });
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
            processBranch(obj.TrueBranch, nodeId, "TrueBranch");
          }

          if (obj.FalseBranch) {
            // Generate nodes for FalseBranch
            processBranch(obj.FalseBranch, nodeId, "FalseBranch");
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
    var res = isSelection(element, from - 1);
    if(res == true){
      from = "endif_" + from;
    }else {
      from = from;
    }
    console.log(res, element, from, to);
    edges.push({ from: from, to: to, label:label });
  }

  function processBranch(element, parent, branch){
    processEdge(element, parent, processIdFormat(element[0].id, parent, branch), processIdFormat(0, parent, branch));
    processElement(element, parent, branch);
    processEdge(element, processIdFormat(element[element.length - 1].id, parent, branch), "endif_" + parent, processIdFormat(element.length, parent, branch));
  }

  function processIdFormat(id, parent, branch){
    var parentLabel = "_" + parent;
    var idLabel = "_" + id;
    return branch + parentLabel + idLabel;
  }

  function isSelection(element, id){
    // console.log(element);
    if (element[id]?.nodetype == "Selection") {
      return true;
    }else {
      return false;
    }
  }

  processElement(element);
  // nodes.push({ id: "element_1", shape: "circle", label: "NGAPUS" });
  // Generate the DOT code for the graph
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

  // console.log(dot);

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

</x-app-layout>
