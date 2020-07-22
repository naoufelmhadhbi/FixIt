import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';

@Component({
  selector: 'app-item-image',
  templateUrl: './item-image.component.html',
  styleUrls: ['./item-image.component.css']
})
export class ItemImageComponent implements OnInit {

  @Input() ListToItem: any;
  @Output() ItemToList = new EventEmitter();

  constructor() {
  }

  ngOnInit() {
  }

  selected() {
    this.ItemToList.emit(
      this.ListToItem
    );
  }

}
