import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';

@Component({
  selector: 'app-list-deplacement',
  templateUrl: './list-deplacement.component.html',
  styleUrls: ['./list-deplacement.component.css']
})
export class ListDeplacementComponent implements OnInit {

  @Input() DepToList;
  @Output() ListToDep = new EventEmitter();

  constructor() {
  }

  ngOnInit() {
  }

  selectionner(dep) {
    this.ListToDep.emit(
      dep
    );
  }


}
