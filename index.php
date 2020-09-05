<?php
?>
<!DOCTYPE html>

<head>
       <meta chraset='UTF-8'>
       <meta name='description' content='make number touch game for practice of JavaScript'>
       <meta name='author' content='takuchan69'>
       <link rel='stylesheet' href='styles.css'>
       <title>TouchNumber</title>
</head>
<body>
       <header>
       <h1>Try Touch Number Game</h1>
       </header>
             <div id='showTime'>00:00</div>
              <section id='container'>
                 <ul id='board'>
                 </ul>
              </section>
              <div id="button" >START</div>

       <footer>
       <p>Refered from Dotinstall</p>
       </footer>
       <script>
       'use strict';
       {
       //get timer show
       const showTime = document.getElementById('showTime');
       let timerId;
      //style of start button
       const button = document.getElementById('button');
       button.addEventListener('mousedown',()=>{
          button.classList.add('btnPressed');
       })
       button.addEventListener('mouseup',()=>{
          button.classList.remove('btnPressed');
       })
       //create timer
       function timer(startTime){
          let now = Date.now()-startTime;
           timerId = setTimeout(()=>{
            showTime.textContent = (now/1000).toFixed(2);
            timer(startTime);
          },200);
       }

       //Panel class
       class Panel{

         constructor(num){
           this.element = document.createElement('li');
           this.element.classList.add('button');
           this.element.textContent = num;
           this.element.addEventListener('click',()=>{
                  this.isFinished();
           })
         }
           getElement(){
            return this.element;
          }

           getNum(){
             return this.element.textContent;
           }

       }

       class Board{
         constructor(){
           this.currentNum = 0;
           this.panels = [];
           this.arrayNum = [0,1,2,3]
           for(let i = 0;i < 4;i++){
             this.panels.push(new Panel(this.arrayNum.splice(Math.floor(Math.random()*this.arrayNum.lenght),1)[0]));
           }
         }

         setup(){
           this.currentNum = 0;
           const board = document.getElementById('board');
           this.panels.forEach((panel)=>{
             board.appendChild(panel.getElement());
             panel.getElement().classList.remove('pressed');
             panel.getElement().addEventListener('click',()=>{
               this.isFinished(panel.getElement().textContent);
               if(parseInt(panel.getElement().textContent) === this.currentNum){
                 console.log('correct!');
                 panel.getElement().classList.add('pressed');
                 this.currentNum += 1;
               }else{
                 console.log('wrong !')
                 console.log(this.currentNum);
               }
             });


           })
         }

        isFinished(textContent){
           if(this.currentNum === parseInt(textContent) && this.currentNum === 3){
             clearTimeout(timerId);
           }
        }





       }
      const board = new Board();
      console.log(board);

      button.addEventListener('click',()=>{
        board.setup();
        const startTime = Date.now();
        timer(startTime);
      })

     }
       </script>
</body>
</html>
