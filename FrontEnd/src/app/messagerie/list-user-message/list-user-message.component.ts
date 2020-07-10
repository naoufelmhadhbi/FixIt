import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-list-user-message',
  templateUrl: './list-user-message.component.html',
  styleUrls: ['./list-user-message.component.css']
})
export class ListUserMessageComponent implements OnInit {
  color : string = "red" ;
  showMessageList : boolean ;
  constructor() { }

  ngOnInit() {
  }

  showMsgList(){
    this.showMessageList = true ;
  }

}
