import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';

@Component({
  selector: 'app-list-metier',
  templateUrl: './list-metier.component.html',
  styleUrls: ['./list-metier.component.css']
})
export class ListMetierComponent implements OnInit {

  @Input() MetToList;
  @Output() ListToMet = new EventEmitter();

  constructor() { }

  ngOnInit() {
  }

  selectionner(dep) {
    this.ListToMet.emit(
      dep
    );
  }

}
