import { Component, OnInit } from '@angular/core';
import {Publication} from '../../Model/Publication';
import {PublicationService} from '../../../Services/PublicationService/publication.service';

@Component({
  selector: 'app-mes-traveaux',
  templateUrl: './mes-traveaux.component.html',
  styleUrls: ['./mes-traveaux.component.css']
})
export class MesTraveauxComponent implements OnInit {
  private publications: Publication[] = [];
  displayedColumns: string[] = ['id'];
  constructor(private publicationService: PublicationService) { }

  ngOnInit() {
    this.publicationService.mesTraveaux().subscribe((data) => {
      this.publications = data;
    });
  }
  click() {
    // this.publicationService.mesTraveaux().subscribe((data) => {
    //   this.publications = data;
    // });

    console.log(this.publications);
  }

}
