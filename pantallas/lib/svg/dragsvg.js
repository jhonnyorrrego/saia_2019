var click=false; // flag to indicate when shape has been clicked
var clickX, clickY; // stores cursor location upon first click
var moveX=0, moveY=0; // keeps track of overall transformation
var lastMoveX=0, lastMoveY=0; // stores previous transformation (move)
function mouseDown(evt){
    evt.preventDefault(); // Needed for Firefox to allow dragging correctly
    click=true;
    clickX = evt.clientX; 
    clickY = evt.clientY;
    evt.target.setAttribute("fill","green");
}

function move(evt){
    evt.preventDefault();
    if(click){
        moveX = lastMoveX + ( evt.clientX – clickX );
        moveY = lastMoveY + ( evt.clientY – clickY );

        evt.target.setAttribute("transform", "translate(" + moveX + "," + moveY + ")");
    }
}

function endMove(evt){
    click=false;
    lastMoveX = moveX;
    lastMoveY = moveY;
    evt.target.setAttribute("fill","gray");
  }