import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {UserProfileComponent} from "../user-profile/user-profile.component";
import {UserInterfaceComponent} from "../user-interface/user-interface.component";
import {MessagerieComponent} from "../messagerie/message/messagerie.component";
import {ListUserMessageComponent} from "../messagerie/list-user-message/list-user-message.component";
import {RouterModule, Routes} from "@angular/router";
import {AccueilComponent} from "../accueil/accueil.component";
import {PublicationsComponent} from '../publications/publications.component';

const routes: Routes = [
  { path: '', component: UserInterfaceComponent ,
      children: [
        { path: 'messagerie', component: MessagerieComponent },
        { path: 'userProfile', component:  UserProfileComponent},
        { path: 'publications', component:  PublicationsComponent },
        { path: 'messagerieUser', component:   ListUserMessageComponent},

      ]
  },
  { path: 'accueil', component: AccueilComponent }
];

@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    RouterModule.forRoot(routes)
  ]
})
export class RoutingModule { }
