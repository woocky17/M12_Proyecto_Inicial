import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './login/login.component';
import {GetAllComponent} from './get-all/get-all.component';

const routes: Routes = [
  {path:'login', component:LoginComponent},
  {path:'getAll', component:GetAllComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
