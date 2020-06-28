import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {UserProfileComponent} from "../user-profile/user-profile.component";
import {RouterModule, Routes} from "@angular/router";
import {AccueilComponent} from "../accueil/accueil.component";

const routes: Routes = [
  { path: 'userProfile', component: UserProfileComponent },
  { path: '', component: AccueilComponent }
];

@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    RouterModule.forRoot(routes)
  ]
})
export class RoutingModule { }
