import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-messagerie',
  templateUrl: './messagerie.component.html',
  styleUrls: ['./messagerie.component.css']
})
export class MessagerieComponent implements OnInit {
  @Input() filsProperty;
  constructor() { }

  ngOnInit() {
    console.log("this is parent variable " + this.filsProperty);
  }
  

}
