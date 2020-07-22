import {FormArray, FormControl, NgModel, Validators} from '@angular/forms';
import {ChangeDetectorRef, Component, ElementRef, OnInit, ViewChild} from '@angular/core';
import {FormBuilder, FormGroup} from '@angular/forms';
import {HttpClient} from '@angular/common/http';
import {PortfolioService} from '../../../Services/PortfolioService/portfolio.service';
import {AuthentificationServiceService} from '../../../Services/AuthentificationService/authentification-service.service';
import {Router} from '@angular/router';
import {User} from '../../Model/user/User';

@Component({
  selector: 'app-add-image',
  templateUrl: './add-image.component.html',
  styleUrls: ['./add-image.component.css']
})
export class AddImageComponent implements OnInit {

  selectedFile: File = null;
  fileToUpload: File = null;
  errorMessage = '';

  /*########################## File Upload ########################*/
  @ViewChild('fileInput') el: ElementRef;
  imageUrl: any = 'https://www.faxinfo.fr/wp-content/uploads/2016/10/travaux-bd.jpg';
  imageUrlBack: any;
  editFile = true;
  removeUpload = false;

  /*##################### Registration Form #####################*/
  registrationForm = this.fb.group({
    file: [null]
  });

  // registrationForm = new FormGroup({
  //   image: new FormControl(''),
  //   desc: new FormControl('')
  //
  // });

  user: User = null;
  name: string;
  desc: string;

  constructor(
    public fb: FormBuilder,
    private cd: ChangeDetectorRef,
    private http: HttpClient,
    private portfolioservice: PortfolioService,
    private authService: AuthentificationServiceService,
    private router: Router
  ) {
  }

  ngOnInit() {

  }

  // get image() {
  //   return this.registrationForm.get('image');
  // }
  // get desc() {
  //   return this.registrationForm.get('desc');
  // }
  // handleFileInput(file: FileList) {
  //   this.fileToUpload = file.item(0);
  //   var reader = new FileReader();
  //   reader.onload = (event: any) => {
  //     this.imageUrlBack = event.target.result;
  //   };
  //   reader.readAsDataURL(this.fileToUpload);
  // }

  Add(event) {
    if (!(event.target.value == null)) {
      this.desc = event.target.value;

      console.log(this.desc);
      this.authService.getByUsr().subscribe((data) => {
        this.user = data[0];
        // console.log(this.user);
        this.addPhoto(this.user.id, this.name, this.desc);
        this.name = '';
        this.desc = '';
        alert('Image ajouté avec succes');
        this.router.navigate(['/portfolio']);

      });
    } else {
      console.log('lala');
    }
  }

  uploadFile(event) {
    const reader = new FileReader(); // HTML5 FileReader API
    // const file = event.target.files[0];
    this.selectedFile = event.target.files[0] as File;
    if (event.target.files && event.target.files[0]) {
      reader.readAsDataURL(this.selectedFile);

      // When file uploads set it to file formcontrol
      reader.onload = () => {
        this.imageUrl = reader.result;
        this.registrationForm.patchValue({
          file: reader.result
        });
        this.editFile = false;
        this.removeUpload = true;
      };
      // ChangeDetectorRef since file is loading outside the zone
      this.cd.markForCheck();
    }
    if (event.target.files.length > 0) {
      const file = event.target.files[0];
      this.name = event.target.files[0].name;
      console.log(this.name);

    }

  }

  addPhoto(id, name, desc) {
    this.portfolioservice.addImage(id, name, desc).subscribe(
      (response) => {
      },
      (error) => {
        this.errorMessage = `Problème de connexion à votre serveur.
          Prière de consulter l'adminstrateur`;
        console.log(error);
      }
    );
  }

}
