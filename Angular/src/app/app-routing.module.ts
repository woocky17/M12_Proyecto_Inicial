import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './login/login.component';
import {GetAllComponent} from './get-all/get-all.component';
import { FindNurseComponent } from './find-nurse/find-nurse.component';

const routes: Routes = [
  {path:'login', component:LoginComponent},
  {path:'findOne', component:FindNurseComponent},
  {path:'getAll', component:GetAllComponent},
  {path:'', component:LoginComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
