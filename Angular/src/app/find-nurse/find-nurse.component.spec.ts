import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FindNurseComponent } from './find-nurse.component';

describe('FindNurseComponent', () => {
  let component: FindNurseComponent;
  let fixture: ComponentFixture<FindNurseComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [FindNurseComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(FindNurseComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
