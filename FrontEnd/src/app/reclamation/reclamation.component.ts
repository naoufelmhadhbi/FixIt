import {Component, OnInit} from '@angular/core';
import {PublicationService} from '../../Services/PublicationService/publication.service';
import {Reclamation} from '../Model/Reclamation';
import {Router} from '@angular/router';

@Component({
  selector: 'app-reclamation',
  templateUrl: './reclamation.component.html',
  styleUrls: ['./reclamation.component.css']
})
export class ReclamationComponent implements OnInit {
  AllReclamation: Reclamation[];

  constructor(private publicationService: PublicationService, private router: Router) {
  }

  ngOnInit() {
    this.chargeList();
  }

  chargeList() {
    // this.AllReclamation = [];
    this.publicationService.GetReclamations().subscribe((data) => {
      // alert('sb');
      // console.log('before ' + this.AllReclamation);
      this.AllReclamation = null;
      this.AllReclamation = data;
      console.log(this.AllReclamation);
      // console.log('after ' + this.AllReclamation);
    });
  }

  delete(id) {
    this.publicationService.DeleteRec(id).subscribe(
      (response) => {
        this.AllReclamation = [];
        this.chargeList();
        // this.router.navigateByUrl('/reclamation', {skipLocationChange: true}).then(() => {
        //     this.router.navigate(['reclamation']);
        //   }
        // );
      });

  }

  redirect(id) {
    this.router.navigate(['/RepRec', id]);
  }
}
