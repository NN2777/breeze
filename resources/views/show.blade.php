<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <input id="nameclass" type="text" placeholder="myclass"> 

  <div id="flowchart" style="text-align: center;"></div>

  <div id="contextMenu"></div>

  <div style="position: relative; padding: 2rem 0 0.5rem 0; border-style: solid; border-color: black">
      <div id="edit" style="text-align: center;"></div>
  </div>
  
  <div style="position: relative; padding: 2rem 0 0.5rem 0; border-style: solid; border-color: black">
      <p id="codearea"></p>
      <ul id="item-list"></ul>
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
        console.log(element);
        console.log(listjavacode);
        main(listjavacode, element);
        generateFlowchart(element);
        genInputBox(element);
        translate(listjavacode);
        change();
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

function genInputBox(element){
  $.each(element, function (index, item) {
          var div = $('<div>').attr('class', 'prompt-area').attr('id', item.id);
          if (item.nodetype === 'Declare') {
              $('<input>').attr('type', 'text').attr('name', 'name').attr('class', 'flowchart-input').val(item.name).appendTo(div);
              $('<input>').attr('type', 'text').attr('name', 'dtype').attr('class', 'flowchart-input').val(item.dtype).appendTo(div);
          } else if (item.nodetype === 'Input') {
              $('<input>').attr('type', 'text').attr('name', 'name').attr('class', 'flowchart-input').val(item.name).appendTo(div);
              $('<input>').attr('type', 'text').attr('name', 'prompt').attr('class', 'flowchart-input').val(item.prompt).appendTo(div);
          } else if (item.nodetype === 'Output') {
              $('<input>').attr('type', 'text').attr('name', 'prompt').attr('class', 'flowchart-input').val(item.prompt).appendTo(div);
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
            refresh();
        },
        error: function(xhr, status, error) {
            // Handle error response
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

function searchshape(element, title){
    var nodetype;
    for (let index = 0; index < element.length; index++) {
      if (element[index].id == title) {
        nodetype = element[index].nodetype;
        break;
      }
    }
    return nodetype;
}

// function insertData(data, insertIndex, newData) {
//   $updatedData = [];
//   $newId = max(array_column($data, 'id')) + 1; // Generate a new unique ID
  
//   for ($i = count($data) - 1; $i >= 0; $i--) {
//     $obj = $data[$i];
//     if ($obj['id'] >= $insertIndex) {
//       $obj['id'] += 1; // Increment the ID
//     }
//     array_unshift($updatedData, $obj); // Add the updated object to the beginning of the array
//   }
  
//   // Create the new data object with the new ID
//   $newData['id'] = $newId;
  
//   // Insert the new data object at the specified index
//   array_splice($updatedData, $insertIndex, 0, [$newData]);
  
//   return $updatedData;
// }


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

function addNewData(dataArray, newData, position) {
  // Increment the IDs of the existing data items after the specified position
  for (var i = position; i < dataArray.length; i++) {
    dataArray[i].id = (parseInt(dataArray[i].id) + 1).toString();
  }

  // Set the new ID for the new data
  newData.id = (position + 1).toString();

  // Insert the new data at the specified position
  dataArray.splice(position, 0, newData);
}


// function shiftIds(dataArray, startIndex, shiftAmount) {
//   for (var i = startIndex; i < dataArray.length; i++) {
//     dataArray[i].id += shiftAmount;
//   }
// }


function showeditmenu(title){
    $(".prompt-area").hide();
    $("#" + title).show();
}

function nodeDot(element) {
    nodes = d3.selectAll('.node');
    nodes
        .on("click", function () {
            var title = d3.select(this).selectAll('title').text().trim();
            var text = d3.select(this).selectAll('text').text();
            var id = d3.select(this).attr('id');
            var class1 = d3.select(this).attr('class');
            var nodetype = searchshape(element, title);
            console.log('Element id="%s" class="%s" title="%s" text="%s" nodetype="%s"', id, class1, title, text, nodetype);
            showeditmenu(title);
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
    
    contextMenu.selectAll('.contextMenu')
        .on('click', function() {
            var menuItem = d3.select(this).text();
            // Perform some action based on the clicked menu item
            console.log('Clicked on:', menuItem);

            var data = defaultData(menuItem);
            addNewData(element, data, parseInt(label));            
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
    var graphviz = d3.select("#flowchart").graphviz()
        .zoom(false);

    // Define the flowchart nodes and edges
    var nodes = [];
    var edges = [];

    // Iterate through the array of objects and create nodes and edges based on the nodetype property
    for (var i = 0; i < element.length; i++) {
        var obj = element[i];
        var id = obj.id;

        switch (obj.nodetype) {
            case "Start":
                nodes.push({ id: id, shape: "circle", label: "Start" });
                break;
            case "Declare":
                var label = obj.name + " = " + obj.dtype;
                nodes.push({ id: id, shape: "hexagon", label: label });
                break;
            case "Assign":
                var label = obj.name + " = " + obj.dtype;
                nodes.push({ id: id, shape: "hexagon", label: label });
                break;    
            case "Input":
                var label = obj.prompt + " " + obj.name;
                nodes.push({ id: id, shape: "parallelogram", label: label });
                break;
            case "Output":
                var label = obj.prompt;
                nodes.push({ id: id, shape: "parallelogram", label: label });
                break;
            case "End":
                nodes.push({ id: id, shape: "circle", label: "End" });
                break;
            default:
                break;
        }

        // Add edges between nodes based on the array index
        if (i > 0) {
            var from = element[i - 1].id;
            var to = id;
            edges.push({ from: from, to: to });
        }
    }

    // Generate the DOT code for the graph
    var dot = 'digraph { \
            node [shape=box style=filled]; \
            ';

    for (var i = 0; i < nodes.length; i++) {
        var node = nodes[i];
        dot += node.id + ' [label="' + node.label + '", shape=' + node.shape + '];\n';
    }

    for (var i = 0; i < edges.length; i++) {
        var edge = edges[i];
        dot += edge.from + ' -> ' + edge.to + ' [label="' + nodes[i].id + '", fontsize=0];\n';
    }

    dot += '}';

    graphviz
        .renderDot(dot)
        .on("end", function () {
            // Get the SVG code generated by graphviz and set it as the innerHTML of the "flowchart" div
            var svg = document.querySelector("#flowchart svg");
            document.querySelector("#flowchart").innerHTML = "";
            document.querySelector("#flowchart").appendChild(svg);
            all(element)
        })
}

</script>

</x-app-layout>
