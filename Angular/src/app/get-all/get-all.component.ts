import { Component, OnInit } from '@angular/core';
import jsonData from '../data/data.json';
import { nurseService } from '../service/nurse.service';

@Component({
  selector: 'app-get-all',
  templateUrl: './get-all.component.html',
  styleUrl: './get-all.component.css',
  providers: [nurseService]
})
export class GetAllComponent {
  nurses: Nurse[] = [];

  constructor(private nurseService: nurseService) { }

  ngOnInit(){
    this.getAll();
  }

  getAll() {
    this.nurseService.getAll().subscribe(
      (data: Nurse[]) => {
        this.nurses = data;
      }
    )
  }
}

class Nurse {
  id: string = '';
  name: string = '';
  pwd: string = '';
  gmail: string = '';
} 