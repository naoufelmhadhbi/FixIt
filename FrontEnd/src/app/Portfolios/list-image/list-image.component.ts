import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';

@Component({
  selector: 'app-list-image',
  templateUrl: './list-image.component.html',
  styleUrls: ['./list-image.component.css']
})
export class ListImageComponent implements OnInit {

  @Input() PortToList;
  @Output() ListToPort = new EventEmitter();
  constructor() { }

  ngOnInit() {
  }

  selectionner(photo) {
    this.ListToPort.emit(
      photo
    );
  }

}
